<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;

class OrderDateProvider
{
    public static function getDayBefore(DateTime $date): DateTime
    {
        return (clone $date)
            ->modify('+1 days')
            ->setTime(0, 0);
    }

    public static function getTwoBefore(DateTime $date): DateTime
    {
        return (clone $date)
            ->modify('+2 days')
            ->setTime(0, 0);
    }
}
