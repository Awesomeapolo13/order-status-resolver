<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;

class CurrentSlotBeginProvider
{
    public static function needHurryToPayUnpaid(DateTime $date): DateTime
    {
        return (clone $date)->modify('-1 hours');
    }

    public static function needPayPaymentTimeExpired(DateTime $date): DateTime
    {
        return (clone $date)->modify('+3 hours');
    }

    public static function readyNeedPayPaidSlotTimeRunning(DateTime $date): DateTime
    {
        return (clone $date)->modify('-45 minutes');
    }

    public static function readyNeedPayPaidSlotTimeExpired(DateTime $date): DateTime
    {
        return (clone $date)->modify('-2 hours');
    }
}
