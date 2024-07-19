<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use DateTime;

readonly class PaymentDateTime
{
    public function __construct(
        private DateTime $paidAt,
        private DateTime $lastPayTime,
    ) {
    }

    public function getPaidAt(): DateTime
    {
        return $this->paidAt;
    }

    public function getLastPayTime(): DateTime
    {
        return $this->lastPayTime;
    }
}
