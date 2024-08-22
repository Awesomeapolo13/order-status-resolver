<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Workflow;

use App\Application\Service\StatusResolver\OrderStatusModel;
use App\Application\Service\Workflow\DTO\WorkflowNameDto;
use App\Application\Service\Workflow\RegistryInterface;
use App\Application\Service\Workflow\WorkflowNameResolver\WorkflowNameResolverInterface;
use App\Application\Service\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Registry;

class SymfonyStatusRegistry implements RegistryInterface
{
    public function __construct(
        private readonly Registry $registry,
        private readonly WorkflowNameResolverInterface $workflowResolver,
    ) {
    }

    /**
     * @param OrderStatusModel $subject
     * @return SymfonyStatusWorkflow
     */
    public function defineWorkflow(object $subject): WorkflowInterface
    {
        $orderType = $subject->getOrderType();
        $workflowName = $this->workflowResolver->resolve(new WorkflowNameDto($orderType));

        return new SymfonyStatusWorkflow(
            $this->registry->get($subject, $workflowName)
        );
    }
}
