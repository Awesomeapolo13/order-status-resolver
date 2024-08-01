<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver\Factory;

use App\Application\Service\StatusResolver\DTO\OrderStatusDto;
use App\Application\Service\StatusResolver\OrderStatusModel;
use App\Domain\Entity\OrderStatus;

class OrderStatusModelFactory
{
    public function createFromDto(OrderStatus $orderStatus, OrderStatusDto $orderStatusDto): OrderStatusModel
    {
        $content = $orderStatus->getContent();

        return new OrderStatusModel(
            $orderStatus->getStatusId(),
            $orderStatus->getCode()->getCode(),
            $content->getTitle(),
            $orderStatusDto->orderType,
            $orderStatusDto->orderState,
            $orderStatusDto->orderDate,
            $orderStatusDto->statusCheckedOutAt,
            $orderStatusDto->workingTime,
            $orderStatusDto->statuses,
            $content->getDefaultSubTitle(),
            $content->getDefaultDescription(),
            $content->getDefaultIcoType(),
            $orderStatusDto->statusId === $orderStatus->getStatusId(),
            $orderStatusDto->delivery,
            $orderStatusDto->currentDateTime,
        );
    }
}
