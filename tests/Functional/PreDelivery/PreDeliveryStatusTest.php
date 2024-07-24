<?php

declare(strict_types=1);

namespace App\Tests\Functional\PreDelivery;

use App\Tests\Tools\Provider\PreDeliveryStatusProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class PreDeliveryStatusTest extends WebTestCase
{
    private AbstractBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /**
     * @dataProvider statusProvider
     */
    public function testPreDeliveryStatuses($request, $expectedResponse): void
    {
        $this->client->request(
            'GET',
            '/status/active',
            $request
        );
        $response = $this->client->getResponse();
        $responseContent = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($responseContent, 'Отсутствует тело ответа');
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResponse), $responseContent);
    }

    private function statusProvider(): array
    {
        return [
            // Статус 0 (Собирается)
            'Статус 0 (Принят) с изначальными описаниями' => PreDeliveryStatusProvider::placed(),
            'Статус 0 с описанием про подготовку на производстве' => PreDeliveryStatusProvider::placedWhenPrepareOnProd(),
            'Из статуса 0 в 11' => PreDeliveryStatusProvider::prepareOnStock(),
            'Из статуса 0 в 12' => PreDeliveryStatusProvider::prepareOnProduction(),
            'Из статуса 0 в 14' => PreDeliveryStatusProvider::partiallyConfirmed(),
            'Из статуса 0 в 14, подготовкой на производстве' => PreDeliveryStatusProvider::partiallyConfirmedPrepareOnProd(),
            // Статус 1 (Собирается)
            'Из статуса 1 в 11' => PreDeliveryStatusProvider::prepareOnStock(),
            'Из статуса 1 в 12' => PreDeliveryStatusProvider::prepareOnProduction(),
            'Из статуса 1 в 14' => PreDeliveryStatusProvider::partiallyConfirmed(),
            'Из статуса 1 в 14 c подготовкой на производстве' => PreDeliveryStatusProvider::partiallyConfirmedPrepareOnProd(),
            // Статус 2 (Готов)
            'Статус 2 без перехода (не оплачен, не истекло время оплаты)' =>
                PreDeliveryStatusProvider::readyNeedPay(),
            'Статус 2 переход в 21 (не оплачен, истекает время оплаты)' =>
                PreDeliveryStatusProvider::readyNeedHurryToPayUnpaid(),
//            'Статус 2 переход в 24 (не оплачен, истекло время оплаты)' =>
//                PreDeliveryStatusProvider::readyNeedPayPaymentTimeExpired(),
//            'Статус 2 переход в 22 (оплачен, время слота ещё не наступило)' =>
//                PreDeliveryStatusProvider::readyNeedPayHasPaid(),
//            'Статус 2 переход в 25 (оплачен, время слота наступили, но не окончено)' =>
//                PreDeliveryStatusProvider::readyNeedPayPaidSlotTimeRunning(),
//            'Статус 2 переход в 26 (оплачен, время слота истекло)' =>
//                PreDeliveryStatusProvider::readyNeedPayPaidSlotTimeExpired(),
        ];
    }
}
