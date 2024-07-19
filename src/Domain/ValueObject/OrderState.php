<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

readonly class OrderState
{
    public function __construct(
        private bool $isPreparingOnProduction,
        private bool $isAvailableInOffice,
        private bool $isFullyConfirmed,
        private bool $hasPaid,
        private bool $canRateOrder,
        private bool $isRated,
    ) {
    }

    public function isPreparingOnProduction(): bool
    {
        return $this->isPreparingOnProduction;
    }

    public function isAvailableInOffice(): bool
    {
        return $this->isAvailableInOffice;
    }

    public function isFullyConfirmed(): bool
    {
        return $this->isFullyConfirmed;
    }

    public function isHasPaid(): bool
    {
        return $this->hasPaid;
    }

    public function isCanRateOrder(): bool
    {
        return $this->canRateOrder;
    }

    public function isRated(): bool
    {
        return $this->isRated;
    }
}
