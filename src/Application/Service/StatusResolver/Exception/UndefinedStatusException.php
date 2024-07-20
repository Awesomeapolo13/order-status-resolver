<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver\Exception;

use RuntimeException;
use Throwable;

class UndefinedStatusException extends RuntimeException
{
    public function __construct(int $statusId, ?Throwable $previous = null)
    {
        parent::__construct('Неизвестный статус с идентификатором ' . $statusId, 0, $previous);
    }
}
