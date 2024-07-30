<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use DateTime;
use DateTimeInterface;

class RequestValidationProvider
{
    public static function emptyStatusId(): array
    {
        $currentDate = new DateTime();

        return [
            [
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
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'statusId',
                        'message' => 'Не передан обязательный параметр statusId',
                    ]
                ],
            ],
        ];
    }

    public static function emptyIsDelivery(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
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
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'isDelivery',
                        'message' => 'Не передан обязательный параметр isDelivery',
                    ]
                ],
            ],
        ];
    }

    public static function emptyIsExpress(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
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
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'isExpress',
                        'message' => 'Не передан обязательный параметр isExpress',
                    ]
                ],
            ],
        ];
    }

    public static function emptyIsPreparingOnProduction(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
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
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'isPreparingOnProduction',
                        'message' => 'Не передан обязательный параметр isPreparingOnProduction',
                    ]
                ],
            ],
        ];
    }

    public static function emptyIsAvailableInOffice(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
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
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'isAvailableInOffice',
                        'message' => 'Не передан обязательный параметр isAvailableInOffice',
                    ]
                ],
            ],
        ];
    }

    public static function emptyIsFullyConfirmed(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'hasPaid' => 0,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'isFullyConfirmed',
                        'message' => 'Не передан обязательный параметр isFullyConfirmed',
                    ]
                ],
            ],
        ];
    }

    public static function emptyHasPaid(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'canRateOrder' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'hasPaid',
                        'message' => 'Не передан обязательный параметр hasPaid',
                    ]
                ],
            ],
        ];
    }

    public static function emptyCanRateOrder(): array
    {
        $currentDate = new DateTime();

        return [
            [
                'statusId' => 0,
                'isDelivery' => 1,
                'isExpress' => 0,
                'isPreparingOnProduction' => 0,
                'isAvailableInOffice' => 1,
                'isFullyConfirmed' => 1,
                'hasPaid' => 0,
                'isRated' => 0,
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'canRateOrder',
                        'message' => 'Не передан обязательный параметр canRateOrder',
                    ]
                ],
            ],
        ];
    }
    public static function emptyIsRated(): array
    {
        $currentDate = new DateTime();

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
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'isRated',
                        'message' => 'Не передан обязательный параметр isRated',
                    ]
                ],
            ],
        ];
    }

    public static function emptyOrderDate(): array
    {
        $currentDate = new DateTime();

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
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'orderDate',
                        'message' => 'Не передан обязательный параметр orderDate',
                    ]
                ],
            ],
        ];
    }

    public static function emptyStatusCheckedOutAt(): array
    {
        $currentDate = new DateTime();

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
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'ttCloseTime' => '22:00',
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'statusCheckedOutAt',
                        'message' => 'Не передан обязательный параметр statusCheckedOutAt',
                    ]
                ],
            ],
        ];
    }

    public static function emptyTtCloseTime(): array
    {
        $currentDate = new DateTime();

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
                'orderDate' => $currentDate->format(DateTimeInterface::ATOM),
                'statusCheckedOutAt' => $currentDate->format(DateTimeInterface::ATOM),
                'courierSearchingTime' => '20',
                'nearestSlotNum' => 23,
                'currentSlotNum' => 20,
                'currentSlotBegin' => $currentDate->format(DateTimeInterface::ATOM),
                'currentSlotLength' => 30,
                'deliveryDate' => $currentDate->format(DateTimeInterface::ATOM),
                'currentDate' => $currentDate->format(DateTimeInterface::ATOM),
            ],
            [
                'title' => 'Некорректные данные запроса',
                'errors' => [
                    [
                        'name' => 'ttCloseTime',
                        'message' => 'Не передан обязательный параметр ttCloseTime',
                    ]
                ],
            ],
        ];
    }
}
