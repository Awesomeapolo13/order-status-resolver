<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\Response\GetActiveStatusResponse;
use App\Domain\Repository\OrderStatusRepositoryInterface;
use App\Domain\Repository\Query\GetStatusesByTypeQuery;

class GetActiveStatusUseCase
{
    public function __construct(
        private readonly OrderStatusRepositoryInterface $orderStatusRepository,
    ) {
    }

    public function __invoke(GetActiveStatusRequest $request): GetActiveStatusResponse
    {
        $statuses = $this->orderStatusRepository->findStatusesByType(
            new GetStatusesByTypeQuery($request->isDelivery, $request->isExpress)
        );

        return new GetActiveStatusResponse('Mock');
    }
}
