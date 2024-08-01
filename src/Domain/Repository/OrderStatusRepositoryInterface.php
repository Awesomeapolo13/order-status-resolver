<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Repository\Query\GetStatusesByTypeQuery;

interface OrderStatusRepositoryInterface
{
    public function findStatusesByType(GetStatusesByTypeQuery $query): array;
}
