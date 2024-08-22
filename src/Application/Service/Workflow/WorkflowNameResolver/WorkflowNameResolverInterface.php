<?php

declare(strict_types=1);

namespace App\Application\Service\Workflow\WorkflowNameResolver;

use App\Application\Service\Workflow\DTO\WorkflowNameDto;

interface WorkflowNameResolverInterface
{
    public function resolve(WorkflowNameDto $dto): string;
}
