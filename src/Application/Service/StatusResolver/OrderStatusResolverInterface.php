<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver;

use App\Application\Service\StatusResolver\DTO\OrderStatusDto;

interface OrderStatusResolverInterface
{
    public function resolveStatus(OrderStatusDto $orderStatusDto): OrderStatusModel;
}
