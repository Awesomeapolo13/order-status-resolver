<?php

declare(strict_types=1);

namespace App\Application\Request;

readonly class GetActiveStatusRequest
{
    public function __construct(
        public ?int $statusId,
        public ?bool $isDelivery,
        public ?bool $isExpress,
        public ?bool $isPreparingOnProduction,
        public ?bool $isAvailableInOffice,
        public ?bool $isFullyConfirmed,
        public ?bool $hasPaid,
        public ?bool $canRateOrder,
        public ?bool $isRated,
        public ?string $orderDate,
        public ?string $statusCheckedOutAt,
        public ?string $ttCloseTime,
        public ?int $nearestSlotNum = null,
        public ?int $currentSlotNum = null,
        public ?string $currentSlotBegin = null,
        public ?int $currentSlotLength = null,
        public ?string $deliveryDate = null,
        public ?string $paidAt = null,
        public ?string $lastPayTime = null,
        public ?string $courierSearchingTime = null,
        public ?string $currentDate = null
    ) {
    }
}
