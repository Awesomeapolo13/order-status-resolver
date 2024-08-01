<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;

class DeliveryDateProvider
{
    public static function readyNeedPayPaidSlotTimeExpired(DateTime $date): DateTime
    {
        return (clone $date)->modify('-1 hours');
    }
}
