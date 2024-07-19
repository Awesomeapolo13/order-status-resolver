<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver\Factory;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\Service\StatusResolver\DTO\OrderStatusDto;

interface OrderStatusDtoFactoryInterface
{
    public function createFromRequest(GetActiveStatusRequest $request): OrderStatusDto;
}
