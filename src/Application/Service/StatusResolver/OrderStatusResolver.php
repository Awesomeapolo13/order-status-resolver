<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver;

use App\Application\Service\StatusResolver\DTO\OrderStatusDto;
use App\Application\Service\StatusResolver\Factory\OrderStatusModelFactory;
use App\Application\Service\StatusResolver\Trait\FindActualStatusTrait;
use App\Application\Service\Workflow\RegistryInterface;
use App\Application\Service\Workflow\WorkflowInterface;

class OrderStatusResolver implements OrderStatusResolverInterface
{
    use FindActualStatusTrait;

    public function __construct(
        private readonly OrderStatusModelFactory $statusModelFactory,
        private readonly RegistryInterface $registry,
    ) {
    }

    public function resolveStatus(OrderStatusDto $orderStatusDto): OrderStatusModel
    {
        $targetModel = $this->findTargetStatusModel($orderStatusDto);
        /** @param WorkflowInterface $workflow */
        $workflow = $this->registry->defineWorkflow($targetModel);
        $workflow->applyTransitionIfItPossible($targetModel);

        $targetModel->updateDescriptionAccordingState();

        return $targetModel;
    }

    private function findTargetStatusModel(OrderStatusDto $orderStatusDto): OrderStatusModel
    {
        $status = $this->findActualStatus($orderStatusDto->statusId, $orderStatusDto->statuses);

        return $this->statusModelFactory->createFromDto($status, $orderStatusDto);
    }
}
