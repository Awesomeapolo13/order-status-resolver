<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;

class DateTimeProvider
{
    public static function hourAgo(DateTime $date): DateTime
    {
        return (clone $date)->modify('-1 hours');
    }

    public static function halfHourAgo(DateTime $date): DateTime
    {
        return (clone $date)->modify('-30 minutes');
    }

    public static function hourBeforeDayEnding(DateTime $date): DateTime
    {
        return (clone $date)->setTime(23, 0);
    }
}
