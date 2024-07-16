<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\Response\GetActiveStatusResponse;

class GetActiveStatusUseCase
{
    public function __invoke(GetActiveStatusRequest $request): GetActiveStatusResponse
    {
        return new GetActiveStatusResponse('Mock');
    }
}
