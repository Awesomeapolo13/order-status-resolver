<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;
use DateTimeInterface;

class ExpressPickUpStatusProvider
{
    public static function placed(): array
    {
        $currentDate = new DateTime();
        $orderDate = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Получили Ваш заказ',
                'subTitle' => null,
                'description' => 'Начнём собирать заказ в ближайшее время.',
                'icoType' => null,
            ],
        ];
    }

    public static function accepted(): array
    {
        $currentDate = new DateTime();
        $orderDate = DateTimeProvider::halfHourAgo($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Собираем заказ',
                'subTitle' => null,
                'description' => 'Собираем Ваш заказ, обычно это занимает 25-45 минут. '
                    . 'Пришлем уведомление, когда заказ будет готов к выдаче.',
                'icoType' => null,
            ],
        ];
    }

    public static function acceptedBuildTimeExpired(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::hourAgo($currentDate);
        $statusCheckedOutAt = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Собираем заказ',
                'subTitle' => 'Задерживается',
                'description' => 'К сожалению, задерживаемся со сборкой заказа. '
                    . 'Пришлем уведомление, когда заказ будет готов к выдаче.',
                'icoType' => 1,
            ],
        ];
    }

    public static function acceptedAfterTtClosed(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::hourAgo($currentDate);
        $statusCheckedOutAt = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'currentDate' => DateTimeProvider::hourBeforeDayEnding($currentDate)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Получили Ваш заказ',
                'subTitle' => null,
                'description' => 'Начнём собирать заказ в ближайшее время.',
                'icoType' => null,
            ],
        ];
    }
}
