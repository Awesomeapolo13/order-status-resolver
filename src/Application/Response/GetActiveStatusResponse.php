<?php

declare(strict_types=1);

namespace App\Application\Response;

readonly class GetActiveStatusResponse
{
    public function __construct(
        public string $title,
        public ?string $subTitle = null,
        public ?string $description = null,
        public ?int $icoType = null,
    ) {
    }
}
