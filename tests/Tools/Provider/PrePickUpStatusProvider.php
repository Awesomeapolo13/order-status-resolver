<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;
use DateTimeInterface;

class PrePickUpStatusProvider
{
    public static function placed(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getTwoBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 0,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Получили Ваш заказ',
                'subTitle' => null,
                'description' => 'Подготовим заказ ко дню исполнения.',
                'icoType' => null,
            ],
        ];
    }

    public static function placedWhenPrepareOnProd(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getTwoBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 0,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Получили Ваш заказ',
                'subTitle' => null,
                'description' => 'Отправили заказ на производство. Будет готов ко дню исполнения.',
                'icoType' => null,
            ],
        ];
    }

    public static function prepareOnStock(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => CurrentDateProvider::fourHourBeforeEndDay($currentDate)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ для передачи в выбранный Вами магазин',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. Пришлем уведомление, когда заказ будет готов к выдаче.',
                'icoType' => null,
            ],
        ];
    }

    public static function prepareOnProduction(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => CurrentDateProvider::fourHourBeforeEndDay($currentDate)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ на производстве',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. Пришлем уведомление, когда заказ будет готов к выдаче.',
                'icoType' => null,
            ],
        ];
    }

    public static function transferringToShop(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 0,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Передаем заказ в магазин',
                'subTitle' => null,
                'description' => 'Ваш заказ уже едет в магазин, который Вы выбрали для самовывоза. '
                    . 'Ожидайте уведомления о готовности к выдаче.',
                'icoType' => null,
            ],
        ];
    }

    public static function partiallyConfirmed(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => CurrentDateProvider::fourHourBeforeEndDay($currentDate)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ подтвержден не полностью',
                'subTitle' => 'Подтвержден не полностью',
                'description' => 'К сожалению, некоторых свежих ингредиентов нет в наличии.'
                    . ' Вы можете оформить дозаказ.',
                'icoType' => null,
            ],
        ];
    }

    public static function transferringToShopAccepted(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;

        return [
            [
                'statusId' => 1,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 0,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Передаем заказ в магазин',
                'subTitle' => null,
                'description' => 'Ваш заказ уже едет в магазин, который Вы выбрали для самовывоза. '
                    . 'Ожидайте уведомления о готовности к выдаче.',
                'icoType' => null,
            ],
        ];
    }

    public static function prepareOnStockAccepted(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getTwoBefore($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ для передачи в выбранный Вами магазин',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. Пришлем уведомление, когда заказ будет готов к выдаче.',
                'icoType' => null,
            ],
        ];
    }

    public static function prepareOnProductionAccepted(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'currentDate' => CurrentDateProvider::fourHourBeforeEndDay($currentDate)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ на производстве',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. Пришлем уведомление, когда заказ будет готов к выдаче.',
                'icoType' => null,
            ],
        ];
    }

    public static function partiallyConfirmedAccepted(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 0,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $orderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'currentDate' => CurrentDateProvider::fourHourBeforeEndDay($currentDate)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ подтвержден не полностью',
                'subTitle' => 'Подтвержден не полностью',
                'description' => 'К сожалению, некоторых свежих ингредиентов нет в наличии. '
                    . 'Вы можете оформить дозаказ.',
                'icoType' => null,
            ],
        ];
    }
}
