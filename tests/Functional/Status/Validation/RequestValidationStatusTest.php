<?php

declare(strict_types=1);

namespace App\Tests\Functional\Status\Validation;

use App\Tests\Tools\Provider\RequestValidationProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Response;

class RequestValidationStatusTest extends WebTestCase
{
    protected AbstractBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /**
     * @dataProvider wrongValidationProvider
     */
    public function testValidationErrorResponse($request, $expectedResponse): void
    {
        $this->client->request(
            'GET',
            '/status/active',
            $request
        );
        $response = $this->client->getResponse();
        $responseContent = $response->getContent();

        $this->assertResponseStatusCodeSame(
            Response::HTTP_BAD_REQUEST,
            'Ожидаемый HTTP-статус 400'
        );
        $this->assertNotEmpty($responseContent, 'Отсутствует тело ответа');
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResponse), $responseContent);
    }

    /**
     * @dataProvider successValidationProvider
     */
    public function testValidationSuccessResponse($request, $expectedResponse): void
    {
        $this->client->request(
            'GET',
            '/status/active',
            $request
        );
        $response = $this->client->getResponse();
        $responseContent = $response->getContent();
        $this->assertResponseIsSuccessful('Ожидаемый HTTP-статус 200');
        $this->assertNotEmpty($responseContent, 'Отсутствует тело ответа');
    }

    protected function wrongValidationProvider(): array
    {
        return [
            'Отсутствует параметр statusId' => RequestValidationProvider::emptyStatusId(),
            'Некорректный параметр statusId' => RequestValidationProvider::wrongStatusId(),
            'Некорректный параметр statusId для самовывоза' => RequestValidationProvider::wrongPickUpStatusId(),
            'Отсутствует параметр isDelivery' => RequestValidationProvider::emptyIsDelivery(),
            'Отсутствует параметр isExpress' => RequestValidationProvider::emptyIsExpress(),
            'Отсутствует параметр isPreparingOnProduction' => RequestValidationProvider::emptyIsPreparingOnProduction(),
            'Отсутствует параметр isAvailableInOffice' => RequestValidationProvider::emptyIsAvailableInOffice(),
            'Отсутствует параметр isFullyConfirmed' => RequestValidationProvider::emptyIsFullyConfirmed(),
            'Отсутствует параметр hasPaid' => RequestValidationProvider::emptyHasPaid(),
            'Отсутствует параметр canRateOrder' => RequestValidationProvider::emptyCanRateOrder(),
            'Отсутствует параметр isRated' => RequestValidationProvider::emptyIsRated(),
            'Отсутствует параметр orderDate' => RequestValidationProvider::emptyOrderDate(),
            'Отсутствует параметр statusCheckedOutAt' => RequestValidationProvider::emptyStatusCheckedOutAt(),
            'Отсутствует параметр ttCloseTime' => RequestValidationProvider::emptyTtCloseTime(),
            'Некорректный формат даты заказа orderDate' => RequestValidationProvider::wrongDateFormat(),
            'Отсутствуют данные о доставке заказа' => RequestValidationProvider::emptyDeliveryData(),
        ];
    }

    public function successValidationProvider(): array
    {
        return [
            'Отсутствуют данные о доставке для самовывоза' => RequestValidationProvider::emptyDeliveryDataWhenPickUp(),
        ];
    }
}
