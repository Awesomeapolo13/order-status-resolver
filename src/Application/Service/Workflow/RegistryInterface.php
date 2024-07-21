<?php

declare(strict_types=1);

namespace App\Application\Service\Workflow;

interface RegistryInterface
{
    public function defineWorkflow(object $subject): WorkflowInterface;
}
