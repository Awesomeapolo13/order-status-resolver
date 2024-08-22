<?php

declare(strict_types=1);

namespace App\Application\Service\Workflow\WorkflowNameResolver;

use App\Application\Service\StatusResolver\Exception\InvalidStatusWorkflow;
use App\Application\Service\Workflow\DTO\WorkflowNameDto;

class ActiveStatusWorkflowNameResolver implements WorkflowNameResolverInterface
{
    private const PRE_DELIVERY_ORDER = 'pre_delivery_order';
    private const PRE_PICK_UP_ORDER = 'pre_pick_up_order';
    private const EXPRESS_DELIVERY_ORDER = 'express_delivery_order';
    private const EXPRESS_PICK_UP_ORDER = 'express_pick_up_order';

    public function resolve(WorkflowNameDto $dto): string
    {
        return match (true) {
            $dto->orderType->isExpressDelivery() => self::EXPRESS_DELIVERY_ORDER,
            $dto->orderType->isExpressPickUp() => self::EXPRESS_PICK_UP_ORDER,
            $dto->orderType->isPreDelivery() => self::PRE_DELIVERY_ORDER,
            $dto->orderType->isPrePickUp() => self::PRE_PICK_UP_ORDER,
            default => throw new InvalidStatusWorkflow(),
        };
    }
}
