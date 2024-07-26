<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;

class PaidAtProvider
{
    public static function paidTwoHoursAgo(DateTime $date): DateTime
    {
        return (clone $date)->modify('-2 hours');
    }
}
