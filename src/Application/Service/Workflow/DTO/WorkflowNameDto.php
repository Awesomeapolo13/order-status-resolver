<?php

declare(strict_types=1);

namespace App\Application\Service\Workflow\DTO;

use App\Domain\ValueObject\OrderType;

readonly class WorkflowNameDto
{
    public function __construct(
        public OrderType $orderType,
    ) {
    }
}
