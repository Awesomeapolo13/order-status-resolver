<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Workflow;

use App\Application\Service\StatusResolver\OrderStatusModel;
use App\Application\Service\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\WorkflowInterface as SymfonyWorkflowInterface;

class SymfonyStatusWorkflow implements WorkflowInterface
{
    public function __construct(
        private SymfonyWorkflowInterface $workflow,
    ) {
    }

    /**
     * @param OrderStatusModel $subject
     * @return void
     */
    public function applyTransitionIfItPossible(object $subject): void
    {
        foreach ($this->workflow->getEnabledTransitions($subject) as $transition) {
            if ($this->workflow->can($subject, $transition->getName())) {
                $this->workflow->apply($subject, $transition->getName());
                break;
            }
        }
    }
}
