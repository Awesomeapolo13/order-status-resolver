<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver\DTO;

use App\Domain\ValueObject\Delivery;
use App\Domain\ValueObject\OrderState;
use App\Domain\ValueObject\OrderType;
use App\Domain\ValueObject\StoreWorkingTime;
use DateTime;

readonly class OrderStatusDto
{
    public function __construct(
        public int $statusId,
        public OrderType $orderType,
        public OrderState $orderState,
        public DateTime $orderDate,
        public DateTime $statusCheckedOutAt,
        public StoreWorkingTime $workingTime,
        public ?Delivery $delivery = null,
        public ?DateTime $currentDateTime = null,
    ) {
    }
}
