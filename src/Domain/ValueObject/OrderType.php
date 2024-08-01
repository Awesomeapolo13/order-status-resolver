<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

readonly class OrderType
{
    public function __construct(
        private bool $isDelivery,
        private bool $isExpress,
    ) {
    }

    public function isPreDelivery(): bool
    {
        return $this->isDelivery && !$this->isExpress;
    }

    public function isPrePickUp(): bool
    {
        return !$this->isDelivery && !$this->isExpress;
    }

    public function isExpressDelivery(): bool
    {
        return $this->isDelivery && $this->isExpress;
    }

    public function isExpressPickUp(): bool
    {
        return !$this->isDelivery && $this->isExpress;
    }

    public function isDelivery(): bool
    {
        return $this->isDelivery;
    }

    public function isExpress(): bool
    {
        return $this->isExpress;
    }
}
