<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Enum\StatusCodeEnum;
use InvalidArgumentException;

readonly class StatusCode
{
    private string $code;

    public function __construct(string $code)
    {
        $this->assertCode($code);
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    private function assertCode(string $code): void
    {
        if (!in_array($code, StatusCodeEnum::cases(), true)) {
            throw new InvalidArgumentException('Неизвестный код статуса ' . $code);
        }
    }
}
