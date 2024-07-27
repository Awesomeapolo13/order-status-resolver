<?php

declare(strict_types=1);

namespace App\Tests\Functional\Status\ExpressDelivery;

use App\Tests\Functional\Status\BaseOrderStatusTest;
use App\Tests\Tools\Provider\ExpressDeliveryStatusProvider;

class ExpressDeliveryStatusTest extends BaseOrderStatusTest
{

    protected function statusProvider(): array
    {
        return [
            // Статус 0 и его переходы
            'Статус 0' => ExpressDeliveryStatusProvider::placed(),
            // Статус 1 и его переходы
            'Статус 1 с изначальным описанием' => ExpressDeliveryStatusProvider::statusAccepted(),
            'Статус 1, истекло время сборки' => ExpressDeliveryStatusProvider::statusAcceptedBuildTimeExpired(),
            'Статус 1, ТТ закрыта, переход в статус 0' => ExpressDeliveryStatusProvider::statusAcceptedAfterTtClosed(),
//            // Статус 2 и его переходы
//            'Статус 2 без перехода (не оплачен, не истекло время оплаты)' =>
//                ExpressDeliveryStatusProvider::correctReadyNeedPay(),
//            'Статус 2 переход в 21 (не оплачен, истекает время оплаты)' =>
//                ExpressDeliveryStatusProvider::correctReadyNeedHurryToPayUnpaid(),
//            'Статус 2 переход в 24 (не оплачен, истекло время оплаты)' =>
//                ExpressDeliveryStatusProvider::correctReadyNeedPayPaymentTimeExpired(),
//            'Статус 2 переход в 22 (оплачен, время слота ещё не наступило)' =>
//                ExpressDeliveryStatusProvider::correctReadyNeedPayHasPaid(),
//            'Статус 2 переход в 25 (оплачен, время слота наступили, но не окончено)' =>
//                ExpressDeliveryStatusProvider::correctReadyNeedPayPaidSlotTimeRunning(),
//            'Статус 2 переход в 26 (оплачен, время слота истекло)' =>
//                ExpressDeliveryStatusProvider::correctReadyNeedPayPaidSlotTimeExpired(),
//            // Переход статуса 4 в 5
//            'Статус 4 переход в 5 (потому что для доставки никто не должен знать о статусе 4)' =>
//                ExpressDeliveryStatusProvider::correctOrderTransfer(),
//            // Статус 5
//            'Статус 5 корректность тестов без переходов' =>
//                ExpressDeliveryStatusProvider::correctOrderTransfer(),
//            // Статус 6, корректность текстов без переходов
//            'Статус 6, можно оценить заказ' =>
//                ExpressDeliveryStatusProvider::correctRecentlyDelivered(),
//            'Статус 6, не поставлена оценка и нельзя уже оценить' =>
//                ExpressDeliveryStatusProvider::correctCanNotBeRatedDelivered(),
//            'Статус 6, поставлена оценка' =>
//                ExpressDeliveryStatusProvider::correctIsRatedDelivered(),
        ];
    }
}
