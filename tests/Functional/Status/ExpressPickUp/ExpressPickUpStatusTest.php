<?php

declare(strict_types=1);

namespace App\Tests\Functional\Status\ExpressPickUp;

use App\Tests\Functional\Status\BaseOrderStatusTest;
use App\Tests\Tools\Provider\ExpressPickUpStatusProvider;

class ExpressPickUpStatusTest extends BaseOrderStatusTest
{

    protected function statusProvider(): array
    {
        return [
            // Статус 0 и его переходы
            'Статус 0' =>
                ExpressPickUpStatusProvider::placed(),
            // Статус 1 и его переходы
            'Статус 1 с изначальным описанием' =>
                ExpressPickUpStatusProvider::accepted(),
            'Статус 1, истекло время сборки' =>
                ExpressPickUpStatusProvider::acceptedBuildTimeExpired(),
            'Статус 1, ТТ закрыта, переход в статус 0' =>
                ExpressPickUpStatusProvider::acceptedAfterTtClosed(),
//            // Статус 2 и его переходы
//            'Статус 2 без перехода (не оплачен, не нужно торопиться за заказом)' =>
//                ExpressPickUpStatusProvider::readyUnpaid(),
//            'Статус 2 переход в 21 (не оплачен, нужно торопиться за заказом)' =>
//                ExpressPickUpStatusProvider::readyNeedToHurryUnpaid(),
//            'Статус 2 переход в 22 (оплачен, не нужно торопиться за заказом)' =>
//                ExpressPickUpStatusProvider::readyPaid(),
//            'Статус 2 переход в 23 (оплачен, нужно торопиться за заказом)' =>
//                ExpressPickUpStatusProvider::readyNeedToHurryPaid(),
//            // Статус 4, изменение текста
//            'Статус 4, можно оценить заказ' =>
//                ExpressPickUpStatusProvider::recentlyFinished(),
//            'Статус 4, не поставлена оценка и нельзя уже оценить' =>
//                ExpressPickUpStatusProvider::canNotBeRatedFinished(),
//            'Статус 4, поставлена оценка' =>
//                ExpressPickUpStatusProvider::isRatedFinished(),
        ];
    }
}
