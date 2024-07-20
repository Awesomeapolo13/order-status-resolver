<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver;

use App\Application\Service\StatusResolver\DTO\OrderStatusDto;
use App\Application\Service\StatusResolver\Exception\UndefinedStatusException;
use App\Application\Service\StatusResolver\Factory\OrderStatusModelFactory;
use App\Application\Service\StatusResolver\Trait\FindActualStatusTrait;

class OrderStatusResolver implements OrderStatusResolverInterface
{
    use FindActualStatusTrait;

    public function __construct(
        private readonly OrderStatusModelFactory $statusModelFactory,
    ) {
    }

    public function resolveStatus(OrderStatusDto $orderStatusDto): OrderStatusModel
    {
        $targetModel = $this->findTargetStatusModel($orderStatusDto);

        // todo: Реализовать переключение статусов в workflow

        $targetModel->updateDescriptionAccordingState($orderStatusDto);

        return $targetModel;
    }

    private function findTargetStatusModel(OrderStatusDto $orderStatusDto): OrderStatusModel
    {
        $status = $this->findActualStatus($orderStatusDto->statusId, $orderStatusDto->statuses);

        return $this->statusModelFactory->createFromDto($status, $orderStatusDto);
    }
}
