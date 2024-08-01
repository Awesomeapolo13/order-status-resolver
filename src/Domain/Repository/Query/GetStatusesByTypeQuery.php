<?php

declare(strict_types=1);

namespace App\Domain\Repository\Query;

readonly class GetStatusesByTypeQuery
{
    public function __construct(
        public bool $isDelivery,
        public bool $isExpress,
    ) {
    }
}
