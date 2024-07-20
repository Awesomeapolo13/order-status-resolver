<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver;

use App\Application\Service\StatusResolver\Trait\FindActualStatusTrait;
use App\Domain\Entity\OrderStatus;
use App\Domain\ValueObject\Delivery;
use App\Domain\ValueObject\OrderState;
use App\Domain\ValueObject\OrderType;
use App\Domain\ValueObject\StatusContent;
use App\Domain\ValueObject\StoreWorkingTime;
use DateTime;

class OrderStatusModel
{
    use FindActualStatusTrait;

    public function __construct(
        private int $statusId,
        private string $code,
        private string $title,
        public OrderType $orderType,
        public OrderState $orderState,
        public DateTime $orderDate,
        public DateTime $statusCheckedOutAt,
        public StoreWorkingTime $workingTime,
        public array $statuses,
        private ?string $subTitle = null,
        private string $description = '',
        private ?int $iconType = null,
        private bool $isActive = false,
        public ?Delivery $delivery = null,
        public ?DateTime $currentDateTime = null,
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
