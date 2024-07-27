<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;

class DateTimeProvider
{
    public static function twoHoursAgo(DateTime $date): DateTime
    {
        return (clone $date)->modify('-2 hours');
    }

    public static function hourAgo(DateTime $date): DateTime
    {
        return (clone $date)->modify('-1 hours');
    }

    public static function fortyFiveMinutesAgo(DateTime $date): DateTime
    {
        return (clone $date)->modify('-45 minutes');
    }

    public static function halfHourAgo(DateTime $date): DateTime
    {
        return (clone $date)->modify('-30 minutes');
    }

    public static function hourBeforeDayEnding(DateTime $date): DateTime
    {
        return (clone $date)->setTime(23, 0);
    }

    public static function threeHoursForward(DateTime $date): DateTime
    {
        return (clone $date)->modify('+3 hours');
    }

    public static function twoHoursForward(DateTime $date): DateTime
    {
        return (clone $date)->modify('+2 hours');
    }
}
