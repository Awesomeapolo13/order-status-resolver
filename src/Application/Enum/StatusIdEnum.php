<?php

declare(strict_types=1);

namespace App\Application\Enum;

enum StatusIdEnum: int
{
    case CANCELLED_BY_SHOP = -2;
    case CANCELED = -1;
    case PLACED = 0;
    case ACCEPTED = 1;
    case READY = 2;
    case FINISHED = 4;
    case TRANSFER_COURIER = 5;
    case DELIVERED = 6;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

