<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Request\GetStatusRequest;
use App\Application\Response\GetActiveStatusResponse;
use App\Application\Response\GetStatusResponse;
use App\Application\Response\StatusListItem;
use App\Application\Service\StatusResolver\Factory\OrderStatusDtoFactoryInterface;
use App\Application\Service\StatusResolver\OrderStatusResolverInterface;
use App\Domain\Repository\OrderStatusRepositoryInterface;
use App\Domain\Repository\Query\GetStatusesByTypeQuery;

class GetStatusUseCase
{
    public function __construct(
        private readonly OrderStatusRepositoryInterface $orderStatusRepository,
        private readonly OrderStatusDtoFactoryInterface $orderStatusDtoFactory,
        private readonly OrderStatusResolverInterface $orderStatusResolver,
    ) {
    }

    public function __invoke(GetStatusRequest $request): GetStatusResponse
    {
        $statuses = $this->orderStatusRepository->findStatusesByType(
            new GetStatusesByTypeQuery($request->isDelivery, $request->isExpress)
        );

        return new GetStatusResponse(
            new GetActiveStatusResponse(
                'Status title',
                'Status subtitle',
                'Text that describes the order state',
                1,
            ),
            [
                new StatusListItem(
                    'First status from list',
                    'Text that describes the first status',
                    'first_code',
                    false,
                ),
                new StatusListItem(
                    'Second status from list',
                    'Text that describes the second status',
                    'second_code',
                    true,
                ),
                new StatusListItem(
                    'Third status from list',
                    'Text that describes the third status',
                    'third_code',
                    false,
                ),
            ]
        );
    }
}
