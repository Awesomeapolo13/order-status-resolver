<?php

declare(strict_types=1);

namespace App\Application\Response;

readonly class StatusListItem
{
    public function __construct(
        public string $title,
        public string $description,
        public string $code,
        public bool $isActive,
    ) {
    }
}
