<?php

declare(strict_types=1);

namespace App\Tests\Functional\Status;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

abstract class BaseOrderStatusTest extends WebTestCase
{
    protected AbstractBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /**
     * @dataProvider statusProvider
     */
    public function testStatuses($request, $expectedResponse): void
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

    protected abstract function statusProvider(): array;
}
