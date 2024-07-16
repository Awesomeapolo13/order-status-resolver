<?php

declare(strict_types=1);

namespace App\Application\Request;

use DateTime;

readonly class GetActiveStatusRequest
{
    public function __construct(
        public int $statusId,
        public bool $isDelivery,
        public bool $isExpress,
        public bool $isPreparingOnProduction,
        public bool $isAvailableInOffice,
        public bool $isFullyConfirmed,
        public bool $isForceMajor,
        public bool $hasPaid,
        public bool $canRateOrder,
        public bool $isRated,
        public DateTime $orderDate,
        public DateTime $statusCheckedOutAt,
        public string $ttCloseTime,
        public ?DateTime $deliveryDate = null,
        public ?DateTime $paidAt = null,
        public ?DateTime $lastPayTime = null,
        public ?string $courierSearchingTime = null,
    ) {
    }
}
