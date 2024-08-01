<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver\Factory;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\Service\StatusResolver\DTO\OrderStatusDto;
use App\Domain\Entity\OrderStatus;

interface OrderStatusDtoFactoryInterface
{
    /**
     * @param OrderStatus[] $statuses
     */
    public function createFromRequest(GetActiveStatusRequest $request, array $statuses): OrderStatusDto;
}
