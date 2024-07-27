<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;
use DateTimeInterface;

class ExpressDeliveryStatusProvider
{
    public static function placed(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 0,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $orderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
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

    public static function statusAccepted(): array
    {
        $currentDate = new DateTime();
        $orderDate = DateTimeProvider::hourAgo($currentDate);
        $statusCheckedOutAt = DateTimeProvider::halfHourAgo($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 1,
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
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $orderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Собираем заказ',
                'subTitle' => null,
                'description' => 'Собираем Ваш заказ, обычно это занимает 25-45 минут. '
                    . 'После сборки и упаковки пришлем уведомление.',
                'icoType' => null,
            ],
        ];
    }

    public static function statusAcceptedBuildTimeExpired(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::hourAgo($currentDate);
        $statusCheckedOutAt = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 1,
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
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $orderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Собираем заказ',
                'subTitle' => 'Задерживается',
                'description' => 'К сожалению, задерживаемся со сборкой заказа. '
                    . 'После сборки и упаковки пришлем уведомление.',
                'icoType' => 1,
            ],
        ];
    }

    public static function statusAcceptedAfterTtClosed(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::hourAgo($currentDate);
        $statusCheckedOutAt = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 1,
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
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $orderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
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
