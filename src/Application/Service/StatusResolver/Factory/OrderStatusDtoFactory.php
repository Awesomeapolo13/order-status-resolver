<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver\Factory;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\Service\StatusResolver\DTO\OrderStatusDto;
use App\Domain\ValueObject\Delivery;
use App\Domain\ValueObject\DeliverySlot;
use App\Domain\ValueObject\OrderState;
use App\Domain\ValueObject\OrderType;
use App\Domain\ValueObject\PaymentDateTime;
use App\Domain\ValueObject\StoreWorkingTime;
use DateTime;
use Exception;

class OrderStatusDtoFactory implements OrderStatusDtoFactoryInterface
{
    /**
     * @throws Exception
     */
    public function createFromRequest(GetActiveStatusRequest $request, array $statuses): OrderStatusDto
    {
        return new OrderStatusDto(
            $request->statusId,
            new OrderType($request->isDelivery, $request->isExpress),
            new OrderState(
                $request->isPreparingOnProduction,
                $request->isAvailableInOffice,
                $request->isFullyConfirmed,
                $request->hasPaid,
                $request->canRateOrder,
                $request->isRated,
            ),
            new DateTime($request->orderDate),
            new DateTime($request->statusCheckedOutAt),
            new StoreWorkingTime($request->ttCloseTime),
            $statuses,
            $request->isDelivery
                ? new Delivery(
                new DateTime($request->deliveryDate),
                new DeliverySlot(
                    $request->nearestSlotNum,
                    $request->currentSlotNum,
                    new DateTime($request->currentSlotBegin),
                    $request->currentSlotLength,
                ),
                isset($request->lastPayTime)
                    ? new PaymentDateTime(
                    !is_null($request->paidAt) ? new DateTime($request->paidAt) : null,
                    new DateTime($request->lastPayTime),
                )
                    : null,
                $request->courierSearchingTime,
            )
                : null,
            new DateTime($request->currentDate),
        );
    }
}
