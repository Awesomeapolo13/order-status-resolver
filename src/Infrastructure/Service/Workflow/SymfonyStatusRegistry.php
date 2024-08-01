<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Workflow;

use App\Application\Service\StatusResolver\Exception\InvalidStatusWorkflow;
use App\Application\Service\StatusResolver\OrderStatusModel;
use App\Application\Service\Workflow\RegistryInterface;
use App\Application\Service\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Registry;

class SymfonyStatusRegistry implements RegistryInterface
{
    private const PRE_DELIVERY_ORDER = 'pre_delivery_order';
    private const PRE_PICK_UP_ORDER = 'pre_pick_up_order';
    private const EXPRESS_DELIVERY_ORDER = 'express_delivery_order';
    private const EXPRESS_PICK_UP_ORDER = 'express_pick_up_order';

    public function __construct(
        private readonly Registry $registry,
    ) {
    }

    /**
     * @param OrderStatusModel $subject
     * @return SymfonyStatusWorkflow
     */
    public function defineWorkflow(object $subject): WorkflowInterface
    {
        $orderType = $subject->getOrderType();

        $workflowName = match (true) {
            $orderType->isExpressDelivery() => self::EXPRESS_DELIVERY_ORDER,
            $orderType->isExpressPickUp() => self::EXPRESS_PICK_UP_ORDER,
            $orderType->isPreDelivery() => self::PRE_DELIVERY_ORDER,
            $orderType->isPrePickUp() => self::PRE_PICK_UP_ORDER,
            default => throw new InvalidStatusWorkflow(),
        };

        return new SymfonyStatusWorkflow(
            $this->registry->get($subject, $workflowName)
        );
    }
}
