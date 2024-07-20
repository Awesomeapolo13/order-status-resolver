<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\Response\GetActiveStatusResponse;
use App\Application\Service\StatusResolver\Factory\OrderStatusDtoFactoryInterface;
use App\Application\Service\StatusResolver\OrderStatusResolverInterface;
use App\Domain\Repository\OrderStatusRepositoryInterface;
use App\Domain\Repository\Query\GetStatusesByTypeQuery;

class GetActiveStatusUseCase
{
    public function __construct(
        private readonly OrderStatusRepositoryInterface $orderStatusRepository,
        private readonly OrderStatusDtoFactoryInterface $orderStatusDtoFactory,
        private readonly OrderStatusResolverInterface $orderStatusResolver,
    ) {
    }

    public function __invoke(GetActiveStatusRequest $request): GetActiveStatusResponse
    {
        $statuses = $this->orderStatusRepository->findStatusesByType(
            new GetStatusesByTypeQuery($request->isDelivery, $request->isExpress)
        );
        // ToDo Возможно никакое ДТО тут вовсе не нужно и стоит сразу создать модель.
        $orderStatusDto = $this->orderStatusDtoFactory->createFromRequest($request, $statuses);
        $statusModel = $this->orderStatusResolver->resolveStatus($orderStatusDto);

        return new GetActiveStatusResponse(
            $statusModel->getTitle(),
            $statusModel->getSubTitle(),
            $statusModel->getDescription(),
            $statusModel->getIconType(),
        );
    }
}
