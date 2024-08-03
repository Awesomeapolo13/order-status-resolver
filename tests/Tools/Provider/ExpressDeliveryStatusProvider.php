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

    public static function readyNeedPay(): array
    {
        $currentDate = new DateTime();
        $orderDate = DateTimeProvider::twoHoursForward($currentDate);
        $deliveryDate = DateTimeProvider::threeHoursForward($currentDate);
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);

        return [
            [
                'statusId' => 2,
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
                'currentSlotBegin' => (clone $deliveryDate)->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::twoHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::hourAgo($orderDate);

        return [
            [
                'statusId' => 2,
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
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => "Заказ собран и ждет оплаты до {lastPayTime}",
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::hourAgo($currentDate);
        $currentSlotBegin = DateTimeProvider::threeHoursForward($orderDate);

        return [
            [
                'statusId' => 2,
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
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::threeHoursForward($orderDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::fortyFiveMinutesAgo($currentDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 20,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $orderDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
                'paidAt' => $paidAt->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Назначаем курьера',
                'subTitle' => null,
                'description' => 'К сожалению, пока курьер не найден. Пожалуйста, подождите немного. '
                    . 'Как только найдем курьера —  Вам придет уведомление.',
                'icoType' => null,
            ],
        ];
    }

    public static function readyNeedPayPaidSlotTimeExpired(): array
    {
        $currentDate = new DateTime();
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::twoHoursAgo($currentDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);
        $deliveryDate = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 2,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::twoHoursAgo($currentDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);
        $deliveryDate = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 4,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::twoHoursAgo($currentDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);
        $deliveryDate = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 5,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::twoHoursAgo($currentDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);
        $deliveryDate = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 6,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 1,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::twoHoursAgo($currentDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);
        $deliveryDate = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 6,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
        $orderDate = $currentDate;
        $statusCheckedOutAt = $currentDate;
        $lastPayTime = DateTimeProvider::threeHoursForward($currentDate);
        $currentSlotBegin = DateTimeProvider::twoHoursAgo($currentDate);
        $paidAt = DateTimeProvider::twoHoursAgo($currentDate);
        $deliveryDate = DateTimeProvider::hourAgo($currentDate);

        return [
            [
                'statusId' => 6,
                'isDelivery' => 1,
                'isExpress' => 1,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 1,
                'canRateOrder' => 0,
                'isRated' => 1,
                'orderDate' => $orderDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $statusCheckedOutAt->format(DateTimeInterface::ATOM),
                'ttCloseTime' => StoreCloseTimeProvider::endInTenPM(),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentSlotBegin->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $deliveryDate->format(DateTimeInterface::ATOM),
                'lastPayTime' => $lastPayTime->format(DateTimeInterface::ATOM),
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
