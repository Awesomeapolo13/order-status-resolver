<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver\Exception;

use RuntimeException;
use Throwable;

class InvalidStatusWorkflow extends RuntimeException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            'Не обнаружено подходящего сценария для изменения статуса заказа',
            0,
            $previous
        );
    }
}
