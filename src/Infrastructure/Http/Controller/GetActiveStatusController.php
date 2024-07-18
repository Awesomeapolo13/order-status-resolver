<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller;

use App\Application\Request\GetActiveStatusRequest;
use App\Application\UseCase\GetActiveStatusUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/status/active', name: 'app_get_order_status', methods: 'GET')]
class GetActiveStatusController extends AbstractController
{
    public function __construct(
        private readonly GetActiveStatusUseCase $activeStatusUseCase,
    ) {
    }

    public function __invoke(
        #[MapQueryString(validationFailedStatusCode: Response::HTTP_BAD_REQUEST)] GetActiveStatusRequest $request
    ): JsonResponse {
        ($this->activeStatusUseCase)($request);

        return $this->json([]);
    }
}
