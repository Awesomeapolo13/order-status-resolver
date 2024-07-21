<?php

declare(strict_types=1);

namespace App\Application\Service\Workflow;

interface WorkflowInterface
{
    public function applyTransitionIfItPossible(object $subject): void;
}
