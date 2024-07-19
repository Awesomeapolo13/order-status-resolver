<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\Response\GetActiveStatusResponse;
use App\Application\Service\StatusResolver\Factory\OrderStatusDtoFactoryInterface;
use App\Domain\Repository\OrderStatusRepositoryInterface;
use App\Domain\Repository\Query\GetStatusesByTypeQuery;

class GetActiveStatusUseCase
{
    public function __construct(
        private readonly OrderStatusRepositoryInterface $orderStatusRepository,
        private readonly OrderStatusDtoFactoryInterface $orderStatusDtoFactory,
    ) {
    }

    public function __invoke(GetActiveStatusRequest $request): GetActiveStatusResponse
    {
        $statuses = $this->orderStatusRepository->findStatusesByType(
            new GetStatusesByTypeQuery($request->isDelivery, $request->isExpress)
        );
        $orderStatusDto = $this->orderStatusDtoFactory->createFromRequest($request);

        return new GetActiveStatusResponse('Mock');
    }
}
