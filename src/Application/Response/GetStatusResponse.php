<?php

declare(strict_types=1);

namespace App\Application\Response;

readonly class GetStatusResponse
{
    /**
     * @param StatusListItem[] $statusList
     */
    public function __construct(
        public GetActiveStatusResponse $activeStatus,
        public array $statusList,
    ) {
    }
}
