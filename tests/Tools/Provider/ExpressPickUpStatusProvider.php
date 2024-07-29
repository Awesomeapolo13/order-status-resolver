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

    public static function readyUnpaid(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $closingTime = StoreCloseTimeProvider::endInTenPM();

        return [
            [
                'statusId' => 2,
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
                'currentDate' => CurrentDateProvider::threeHourBeforeClosing($currentDate, $closingTime)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ готов к выдаче',
                'subTitle' => null,
                'description' => "Заказ ждет Вас в магазине! Заберите до {ttCloseTime}.",
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedToHurryUnpaid(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $closingTime = StoreCloseTimeProvider::endInTenPM();

        return [
            [
                'statusId' => 2,
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
                'ttCloseTime' => $closingTime,
                'currentDate' => CurrentDateProvider::hourBeforeClosing($currentDate, $closingTime)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ готов к выдаче. Успейте забрать',
                'subTitle' => 'Успейте забрать',
                'description' => "Заказ ждет Вас в магазине! Заберите до {ttCloseTime}.",
                'icoType' => null,
            ],
        ];
    }

    public static function readyPaid(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $closingTime = StoreCloseTimeProvider::endInTenPM();

        return [
            [
                'statusId' => 2,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => $closingTime,
                'currentDate' => CurrentDateProvider::threeHourBeforeClosing($currentDate, $closingTime)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ собран и оплачен',
                'subTitle' => null,
                'description' => 'Заказ ждет Вас в магазине! Заберите до 21:00. '
                    . 'При получении назовите код из уведомления.',
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedToHurryPaid(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $closingTime = StoreCloseTimeProvider::endInTenPM();

        return [
            [
                'statusId' => 2,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => $closingTime,
                'currentDate' => CurrentDateProvider::hourBeforeClosing($currentDate, $closingTime)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ собран и оплачен. Успейте забрать',
                'subTitle' => 'Успейте забрать',
                'description' => "Заказ ждет Вас в магазине! Заберите до {ttCloseTime}.",
                'icoType' => null,
            ],
        ];
    }

    public static function recentlyFinished(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $closingTime = StoreCloseTimeProvider::endInTenPM();

        return [
            [
                'statusId' => 4,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 1,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => $closingTime,
                'currentDate' => CurrentDateProvider::hourBeforeClosing($currentDate, $closingTime)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ получен',
                'subTitle' => null,
                'description' => 'Пожалуйста, оцените заказ',
                'icoType' => null,
            ],
        ];
    }

    public static function canNotBeRatedFinished(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $closingTime = StoreCloseTimeProvider::endInTenPM();

        return [
            [
                'statusId' => 4,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => $closingTime,
                'currentDate' => CurrentDateProvider::hourBeforeClosing($currentDate, $closingTime)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ получен',
                'subTitle' => null,
                'description' => '',
                'icoType' => null,
            ],
        ];
    }

    public static function isRatedFinished(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $closingTime = StoreCloseTimeProvider::endInTenPM();

        return [
            [
                'statusId' => 4,
                'isDelivery' => 0,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 1,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => $closingTime,
                'currentDate' => CurrentDateProvider::hourBeforeClosing($currentDate, $closingTime)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ получен',
                'subTitle' => null,
                'description' => 'Спасибо за оценку',
                'icoType' => null,
            ],
        ];
    }
}
