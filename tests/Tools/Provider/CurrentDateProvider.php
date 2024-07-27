<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;

class CurrentDateProvider
{
    public static function fourHourBeforeEndDay(DateTime $date): DateTime
    {
        return (clone $date)->setTime(20, 0);
    }

    public static function threeHourBeforeClosing(DateTime $date, string $closingTime): DateTime
    {
        $closeHour = substr($closingTime, 0, 2);

        return (clone $date)
            ->setTime((int)$closeHour, 0)
            ->modify('-3 hour');
    }

    public static function hourBeforeClosing(DateTime $date, string $closingTime): DateTime
    {
        $closeHour = substr($closingTime, 0, 2);

        return (clone $date)
            ->setTime((int)$closeHour, 0)
            ->modify('-1 hour');
    }
}
