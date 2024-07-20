<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use DateTime;

readonly class DeliverySlot
{
    public function __construct(
        private int $nearestSlotNum,
        private int $currentSlotNum,
        private DateTime $currentSlotBegin,
        private int $currentSlotLength,
    ) {
    }

    public function getNearestSlotNum(): int
    {
        return $this->nearestSlotNum;
    }

    public function getCurrentSlotNum(): int
    {
        return $this->currentSlotNum;
    }

    public function getCurrentSlotBegin(): DateTime
    {
        return $this->currentSlotBegin;
    }

    public function getCurrentSlotLength(): int
    {
        return $this->currentSlotLength;
    }
}
