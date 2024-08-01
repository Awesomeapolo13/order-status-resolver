<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use InvalidArgumentException;

readonly class StoreWorkingTime
{
    private string $ttCloseTime;

    public function __construct(
        string $ttCloseTime,
    ) {
        $this->assertStoreTime($ttCloseTime);
        $this->ttCloseTime = $ttCloseTime;
    }

    public function getTtCloseTime(): string
    {
        return $this->ttCloseTime;
    }

    public function getTtCloseHour(): string
    {
        return substr($this->ttCloseTime, 0, 2);
    }

    public function getTtCloseMinutes(): string
    {
        return substr($this->ttCloseTime, 2, 2);
    }

    private function assertStoreTime(string $time): void
    {
        if (!preg_match('/\d{2}:\d{2}/', $time)) {
            throw new InvalidArgumentException('Не корректный формат времени');
        }
    }
}
