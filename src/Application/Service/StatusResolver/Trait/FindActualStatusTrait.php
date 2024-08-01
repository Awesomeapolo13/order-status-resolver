<?php

namespace App\Application\Service\StatusResolver\Trait;

use App\Application\Service\StatusResolver\Exception\UndefinedStatusException;
use App\Domain\Entity\OrderStatus;

trait FindActualStatusTrait
{
    /**
     * @param OrderStatus[] $statuses
     */
    private function findActualStatus(int $statusId, array $statuses): OrderStatus
    {
        foreach ($statuses as $status) {
            if ($status->getStatusId() === $statusId) {
                return $status;
            }
        }

        throw new UndefinedStatusException($statusId);
    }
}