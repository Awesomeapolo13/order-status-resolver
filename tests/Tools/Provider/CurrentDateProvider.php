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
}
