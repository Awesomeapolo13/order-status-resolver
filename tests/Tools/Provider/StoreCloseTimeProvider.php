<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

class StoreCloseTimeProvider
{
    public static function endInTenPM(): string
    {
        return '22:00';
    }
}
