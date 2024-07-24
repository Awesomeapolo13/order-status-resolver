<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver;

use App\Application\Service\StatusResolver\Trait\FindActualStatusTrait;
use App\Domain\Entity\OrderStatus;
use App\Domain\ValueObject\Delivery;
use App\Domain\ValueObject\DeliverySlot;
use App\Domain\ValueObject\OrderState;
use App\Domain\ValueObject\OrderType;
use App\Domain\ValueObject\StatusContent;
use App\Domain\ValueObject\StoreWorkingTime;
use DateTime;
use Exception;

class OrderStatusModel
{
    use FindActualStatusTrait;

    public function __construct(
        private int             $statusId,
        private string          $code,
        private string          $title,
        public OrderType        $orderType,
        public OrderState       $orderState,
        public DateTime         $orderDate,
        public DateTime         $statusCheckedOutAt,
        public StoreWorkingTime $workingTime,
        public array            $statuses,
        private ?string         $subTitle = null,
        private string          $description = '',
        private ?int            $iconType = null,
        private bool            $isActive = false,
        public ?Delivery        $delivery = null,
        public ?DateTime        $currentDateTime = null,
    ) {
    }

    public function updateDescriptionAccordingState(): void
    {
        $actualStatus = $this->findActualStatus($this->statusId, $this->statuses);
        $this->setDefault($actualStatus);
        $content = $actualStatus->getContent();

        $this->updateContent($content->getDescription(), 'description');
        $this->updateContent($content->getSubTitle(), 'subTitle');
        $this->updateContent($content->getIcoType(), 'iconType');
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIconType(): ?int
    {
        return $this->iconType;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function isPreparingOnProduction(): bool
    {
        return $this->orderState->isPreparingOnProduction();
    }

    public function isAvailableInOffice(): bool
    {
        return $this->orderState->isAvailableInOffice();
    }

    public function isFullyConfirmed(): bool
    {
        return $this->orderState->isFullyConfirmed();
    }

    public function isAvailableInOfficeAndNotFullyConfirmed(): bool
    {
        return $this->orderState->isAvailableInOffice() && !$this->isFullyConfirmed();
    }

    public function hasPaid(): bool
    {
        return $this->orderState->isHasPaid();
    }

    public function getOrderType(): OrderType
    {
        return $this->orderType;
    }

    public function lessThan8HoursToOrderDate(): bool
    {
        return $this->currentDateTime > (clone $this->orderDate)
                ->setTime(0, 0, 0)
                ->modify('-8 hours');
    }

    public function isPreparingOnStockFromPlaced(): bool
    {
        return !$this->isPreparingOnProduction() && $this->isAvailableInOffice() && $this->lessThan8HoursToOrderDate();
    }

    /**
     * Вернет true, если сегодня дата выдачи заказа
     */
    public function isOrderDateToday(): bool
    {
        return $this->currentDateTime >= (clone $this->orderDate)->setTime(0, 0, 0);
    }

    public function isTransferringToShopFromPlaced(): bool
    {
        return !($this->isAvailableInOffice() && $this->lessThan8HoursToOrderDate())
            && $this->isOrderDateToday();
    }

    public function isPreparingOnProductionFromPlaced(): bool
    {
        return $this->isPreparingOnProduction() && $this->isAvailableInOffice() && $this->lessThan8HoursToOrderDate();
    }

    public function isAvailableInOfficeAndNotFullyConfirmedFromPlaced(): bool
    {
        return $this->isAvailableInOffice()
            && $this->lessThan8HoursToOrderDate()
            && $this->isAvailableInOfficeAndNotFullyConfirmed();
    }

    public function isTransferringToShop(): bool
    {
        return $this->isOrderDateToday();
    }

    /**
     * Надо торопиться забрать заказ, если текущее время больше чем за два часа до закрытия.
     *
     * @throws Exception
     */
    public function isNeedToHurryUp(): bool
    {
        $closeTime = $this->workingTime->getTtCloseTime();

        return (new DateTime($closeTime))->modify('-2 hours') < $this->currentDateTime;
    }


    /**
     * @throws Exception
     */
    public function isNeedToHurryUpUnpaid(): bool
    {
        return !$this->hasPaid() && $this->isNeedToHurryUp();
    }

    /**
     * @throws Exception
     */
    public function isNeedToHurryUpPaid(): bool
    {
        return $this->hasPaid() && $this->isNeedToHurryUp();
    }

    public function isNeedToHurryToPayUnpaid(): bool
    {
        $deliverySlot = $this->delivery->getDeliverySlot();

        return !$this->hasPaid()
            && !is_null($deliverySlot->getCurrentSlotBegin())
            && $this->currentDateTime >= (clone $deliverySlot->getCurrentSlotBegin())
                // todo Вынести в константу или словарь (а лучше получать из вне)
                ->modify('-20 minutes');
    }

    public function isPaymentTimeExpired(): bool
    {
        $payment = $this->delivery->getPaymentDateTime();

        return !$this->hasPaid()
            && $this->currentDateTime > $payment->getLastPayTime();
    }

    /**
     * @throws Exception
     */
    public function isSlotTimeRunningAndPaid(): bool
    {
        return $this->hasPaid()
            && $this->isCloseTimeSLot()
            || (
                $this->isCurrentSlotBegan()
                && !$this->isCurrentSlotEnded()
            );
    }

    public function isSlotTimeExpiredAndPaid(): bool
    {
        return $this->hasPaid()
            && !$this->isCloseTimeSLot()
            && $this->isCurrentSlotEnded()
            && $this->isCourierSearchingTimeExpired();
    }

    public function isOrderCanNotBeRated(): bool
    {
        return !$this->orderState->isCanRateOrder();
    }

    public function isOrderRated(): bool
    {
        return $this->orderState->isRated();
    }

    public function isTtClosed(): bool
    {
        $ttWorkingTime = $this->workingTime;

        return (new DateTime())
                ->setTime(
                    (int)$ttWorkingTime->getTtCloseHour(),
                    (int)$ttWorkingTime->getTtCloseMinutes()
                ) < $this->currentDateTime;
    }

    public function isBuiltExpired(): bool
    {
        $lastStatusAt = $this->statusCheckedOutAt;
        // todo Вынести 45 минут в константу
        return $this->currentDateTime >= (clone $lastStatusAt)->modify('+45 minutes');
    }

    private function isCloseTimeSLot(): bool
    {
        $slot = $this->delivery->getDeliverySlot();

        return $slot->getCurrentSlotNum() === $slot->getNearestSlotNum();
    }

    /**
     * Вернет true, если текущий слот истек.
     *
     * @throws Exception
     */
    private function isCurrentSlotBegan(): bool
    {
        $slot = $this->delivery->getDeliverySlot();

        return $this->currentDateTime > $slot->getCurrentSlotBegin();
    }

    private function isCurrentSlotEnded(): bool
    {
        $slot = $this->delivery->getDeliverySlot();

        return !is_null($slot->getCurrentSlotBegin()) && new DateTime() > (clone $slot->getCurrentSlotBegin())
                ->modify('+' . $slot->getCurrentSlotLength() . ' minutes');
    }

    /**
     * Вернет true, если текущий DateTime превышает DateTime доставки + время ожидания курьера
     * и DateTime времени старта оплаты + время ожидания курьера.
     */
    private function isCourierSearchingTimeExpired(): bool
    {
        $payment = $this->delivery->getPaymentDateTime();
        $courierSearchingTime = $this->delivery->getCourierSearchingTime();
        $payStartedAtModified = $payment->getPaidAt()
            ?
            (clone $payment->getPaidAt())
                ->modify('+' . $courierSearchingTime . ' minutes')
            :
            null;

        return $this->currentDateTime > (clone $this->delivery->getDeliveryDate())
                ->modify('+' . $courierSearchingTime . ' minutes')
            && $this->currentDateTime > $payStartedAtModified;
    }

    private function setDefault(OrderStatus $status): void
    {
        $content = $status->getContent();

        $this->title = $content->getTitle();
        $this->subTitle = $content->getDefaultSubTitle();
        $this->description = $content->getDefaultDescription();
        $this->iconType = $content->getDefaultIcoType();
        $this->code = $status->getCode()->getCode();
    }

    private function updateContent(array $content, string $contentProperty): void
    {
        foreach ($content as $key => $item) {
            if ($key === StatusContent::DEFAULT_CONTENT_KEY) {
                continue;
            }

            if (method_exists($this, $key) && call_user_func([$this, $key])) {
                $this->{$contentProperty} = $item;
                break;
            }
        }
    }
}
