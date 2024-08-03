<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;
use DateTimeInterface;

class PreDeliveryStatusProvider
{
    public static function placed(): array
    {
        $currentDate = new DateTime();
        $preDeliveryOrderDate = OrderDateProvider::getTwoBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 0,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
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
        $preDeliveryOrderDate = OrderDateProvider::getTwoBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 0,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
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
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => CurrentDateProvider::fourHourBeforeEndDay($currentDate)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ для доставки',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. После сборки и упаковки пришлем уведомление.',
                'icoType' => null,
            ],
        ];
    }

    public static function prepareOnProduction(): array
    {
        $currentDate = new DateTime();
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate // За час до окончания текущего дня.
                    ->setTime(23, 0)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ на производстве',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. После сборки и упаковки пришлем уведомление.',
                'icoType' => null,
            ],
        ];
    }

    public static function partiallyConfirmed(): array
    {
        $currentDate = new DateTime();
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate // За час до окончания текущего дня.
                    ->setTime(23, 0)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ подтвержден не полностью',
                'subTitle' => 'Подтвержден не полностью',
                'description' => 'Вы можете оформить дозаказ. Соберем и упакуем заказ в одну доставку!',
                'icoType' => null,
            ],
        ];
    }

    public static function partiallyConfirmedPrepareOnProd(): array
    {
        $currentDate = new DateTime();
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate // За час до окончания текущего дня.
                    ->setTime(23, 0)
                    ->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ подтвержден не полностью',
                'subTitle' => 'Подтвержден не полностью',
                'description' => 'К сожалению, некоторых свежих ингредиентов нет в наличии. '
                    . 'Вы можете оформить дозаказ. Соберем и упакуем заказ в одну доставку!',
                'icoType' => null,
            ],
        ];
    }

    public static function prepareOnStockAccepted(): array
    {
        $currentDate = new DateTime();
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ для доставки',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. После сборки и упаковки пришлем уведомление.',
                'icoType' => null,
            ],
        ];
    }

    public static function prepareOnProductionAccepted(): array
    {
        $currentDate = new DateTime();
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Готовим заказ на производстве',
                'subTitle' => null,
                'description' => 'Заказ подтвержден. После сборки и упаковки пришлем уведомление.',
                'icoType' => null,
            ],
        ];
    }

    public static function partiallyConfirmedAccepted(): array
    {
        $currentDate = new DateTime();
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ подтвержден не полностью',
                'subTitle' => 'Подтвержден не полностью',
                'description' => 'Вы можете оформить дозаказ. Соберем и упакуем заказ в одну доставку!',
                'icoType' => null,
            ],
        ];
    }

    public static function partiallyConfirmedPrepareOnProdAccepted(): array
    {
        $currentDate = new DateTime();
        // За день до даты заказа
        $preDeliveryOrderDate = OrderDateProvider::getDayBefore($currentDate);

        return [
            [
                'statusId' => 1,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => (clone $preDeliveryOrderDate)
                    ->setTime(16, 0)
                    ->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $preDeliveryOrderDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ подтвержден не полностью',
                'subTitle' => 'Подтвержден не полностью',
                'description' => 'К сожалению, некоторых свежих ингредиентов нет в наличии. '
                    . 'Вы можете оформить дозаказ. Соберем и упакуем заказ в одну доставку!',
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedPay(): array
    {
        $currentDate = new DateTime();
        $lastPayTime = (clone $currentDate)->modify('+3 hours');

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 1,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $lastPayTime->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $lastPayTime->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
                'paidAt' => null,
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ собран и ожидает оплаты',
                'subTitle' => null,
                'description' => 'После оплаты передадим заказ курьеру, чтобы доставить к выбранному времени.',
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedHurryToPayUnpaid(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needHurryToPayUnpaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::NeedHurryToPayUnpaid($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 0,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => null,
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ собран и ждет оплаты до {lastPayTime}',
                'subTitle' => 'Ожидает оплаты',
                'description' => 'Пожалуйста, оплатите заказ, чтобы мы доставили его к выбранному Вами времени. '
                    . 'Сразу после оплаты мы назначим курьера.',
                'icoType' => 2,
            ],
        ];
    }

    public static function readyNeedPayPaymentTimeExpired(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayPaymentTimeExpired($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::needPayPaymentTimeExpired($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => null,
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Не оплачен вовремя',
                'subTitle' => null,
                'description' => 'Не получили оплату по заказу.',
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedPayHasPaid(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::needPayPaymentTimeExpired($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ оплачен. Назначим курьера к выбранному Вами времени',
                'subTitle' => null,
                'description' => 'Когда курьер будет найден, Вам придет уведомление.',
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedPayPaidSlotTimeRunning(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::readyNeedPayPaidSlotTimeRunning($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 20,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Назначаем курьера',
                'subTitle' => null,
                'description' => 'Когда курьер будет найден, Вам придет уведомление для отслеживания статуса доставки.',
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedPayPaidSlotTimeExpired(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::readyNeedPayPaidSlotTimeExpired($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);
        $deliveryDate = DeliveryDateProvider::readyNeedPayPaidSlotTimeExpired($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 20,
                'currentSlotNum' => 30,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Назначаем курьера. Задерживаемся.',
                'subTitle' => 'Задерживается',
                'description' => 'К сожалению, пока курьер не найден. Пожалуйста, подождите немного. '
                    . 'Как только найдем курьера —  Вам придет уведомление для отслеживания статуса доставки.',
                'icoType' => 1,
            ],
        ];
    }

    public static function orderFinishedToTransfer(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::needPayPaymentTimeExpired($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);

        return [
            [
                'statusId' => 4,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Курьер в пути',
                'subTitle' => null,
                'description' => 'Передали Ваш заказ курьеру. Ожидайте доставку.',
                'icoType' => null,
            ],
        ];
    }

    public static function orderTransfer(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::needPayPaymentTimeExpired($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);

        return [
            [
                'statusId' => 5,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Курьер в пути',
                'subTitle' => null,
                'description' => 'Передали Ваш заказ курьеру. Ожидайте доставку.',
                'icoType' => null,
            ],
        ];
    }

    public static function recentlyDelivered(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::needPayPaymentTimeExpired($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);

        return [
            [
                'statusId' => 6,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 1,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ доставлен',
                'subTitle' => null,
                'description' => 'Пожалуйста, оцените заказ',
                'icoType' => null,
            ],
        ];
    }

    public static function canNotBeRatedDelivered(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::needPayPaymentTimeExpired($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);

        return [
            [
                'statusId' => 6,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ доставлен',
                'subTitle' => null,
                'description' => '',
                'icoType' => null,
            ],
        ];
    }

    public static function isRatedDelivered(): array
    {
        $currentDate = new DateTime();
        $lastPayDt = LastPayDateProvider::needPayHasPaid($currentDate);
        $currentSlotBegun = CurrentSlotBeginProvider::needPayPaymentTimeExpired($currentDate);
        $paidAt = PaidAtProvider::paidTwoHoursAgo($currentDate);

        return [
            [
                'statusId' => 6,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 1,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegun->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayDt->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Заказ доставлен',
                'subTitle' => null,
                'description' => 'Спасибо за оценку',
                'icoType' => null,
            ],
        ];
    }
}
