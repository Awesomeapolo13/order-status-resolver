<?php

declare(strict_types=1);

namespace App\Tests\Functional\Status\PrePickUp;

use App\Tests\Functional\Status\BaseOrderStatusTest;
use App\Tests\Tools\Provider\PrePickUpStatusProvider;

class PrePickUpStatusTest extends BaseOrderStatusTest
{
    protected function statusProvider(): array
    {
        return [
            // Статус 0 и его переходы
            'Статус 0 с изначальными описаниями' =>
                PrePickUpStatusProvider::placed(),
            'Статус 0 с описанием про подготовку на производстве' =>
                PrePickUpStatusProvider::placedWhenPrepareOnProd(),
            'Переход из статуса 0 в 11' => PrePickUpStatusProvider::prepareOnStock(),
            'Переход из статуса 0 в 12' => PrePickUpStatusProvider::prepareOnProduction(),
            'Переход из статуса 0 в 13' => PrePickUpStatusProvider::transferringToShop(),
            'Переход из статуса 0 в 14' => PrePickUpStatusProvider::partiallyConfirmed(),
            // Статус 1 и его переходы
            'Переход из статуса 1 в 13' => PrePickUpStatusProvider::transferringToShopAccepted(),
            'Переход из статуса 1 в 11' => PrePickUpStatusProvider::prepareOnStockAccepted(),
            'Переход из статуса 1 в 12' => PrePickUpStatusProvider::prepareOnProductionAccepted(),
            'Переход из статуса 1 в 14' => PrePickUpStatusProvider::partiallyConfirmedAccepted(),
//            // Статус 2 и его переходы
//            'Статус 2 без перехода (не оплачен, не нужно торопиться за заказом)' =>
//                PrePickUpStatusReadyProvider::correctReadyUnpaid($statusList),
//            'Статус 2 переход в 21 (не оплачен, нужно торопиться за заказом)' =>
//                PrePickUpStatusReadyProvider::correctReadyNeedToHurryUnpaid($statusList),
//            'Статус 2 переход в 22 (оплачен, не нужно торопиться за заказом)' =>
//                PrePickUpStatusReadyProvider::correctReadyPaid($statusList),
//            'Статус 2 переход в 23 (оплачен, нужно торопиться за заказом)' =>
//                PrePickUpStatusReadyProvider::correctReadyNeedToHurryPaid($statusList),
//            // Статус 3 и его переходы
//            'Статус 3 без перехода (не оплачен, не нужно торопиться за заказом)' =>
//                PrePickUpStatusPartiallyReadyProvider::correctPartiallyReadyUnpaid($statusList),
//            'Статус 3 переход в 31 (не оплачен, нужно торопиться за заказом)' =>
//                PrePickUpStatusPartiallyReadyProvider::correctPartiallyReadyNeedToHurryUnpaid($statusList),
//            'Статус 3 переход в 32 (оплачен, не нужно торопиться за заказом)' =>
//                PrePickUpStatusPartiallyReadyProvider::correctPartiallyReadyPaid($statusList),
//            'Статус 3 переход в 33 (оплачен, нужно торопиться за заказом)' =>
//                PrePickUpStatusPartiallyReadyProvider::correctPartiallyReadyNeedToHurryPaid($statusList),
//            // Статус 4, изменение текста
//            'Статус 4, можно оценить заказ' =>
//                PrePickUpStatusFinishedProvider::correctRecentlyFinished($statusList),
//            'Статус 4, не поставлена оценка и нельзя уже оценить' =>
//                PrePickUpStatusFinishedProvider::correctCanNotBeRatedFinished($statusList),
//            'Статус 4, поставлена оценка' =>
//                PrePickUpStatusFinishedProvider::correctIsRatedFinished($statusList),
        ];
    }
}
