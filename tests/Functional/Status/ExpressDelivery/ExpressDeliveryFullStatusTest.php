<?php

declare(strict_types=1);

namespace App\Tests\Functional\Status\ExpressDelivery;

use App\Tests\Tools\Provider\OrderDateProvider;
use App\Tests\Tools\Provider\StoreCloseTimeProvider;
use DateTime;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class ExpressDeliveryFullStatusTest extends WebTestCase
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
    public function testFullStatuses($request, $expectedResponse): void
    {
        $this->client->request('GET', '/status', $request);
        $response = $this->client->getResponse();
        $responseContent = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($responseContent, 'Отсутствует тело ответа');
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResponse), $responseContent);
    }

    protected function statusProvider(): array
    {
        $currentDate = new DateTime();
        $orderDate = OrderDateProvider::hourAgo($currentDate);

        return [
            'Initial test' => [
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
                    'activeStatus' => [
                        'title' => 'Status title',
                        'subTitle' => 'Status subtitle',
                        'description' => 'Text that describes the order state',
                        'icoType' => 1,
                    ],
                    'statusList' => [
                        [
                            'title' => 'First status from list',
                            'description' => 'Text that describes the first status',
                            'code' => 'first_code',
                            'isActive' => false,
                        ],
                        [
                            'title' => 'Second status from list',
                            'description' => 'Text that describes the second status',
                            'code' => 'second_code',
                            'isActive' => true,
                        ],
                        [
                            'title' => 'Third status from list',
                            'description' => 'Text that describes the third status',
                            'code' => 'third_code',
                            'isActive' => false,
                        ],
                    ],
                ],
            ],
        ];
    }
}
