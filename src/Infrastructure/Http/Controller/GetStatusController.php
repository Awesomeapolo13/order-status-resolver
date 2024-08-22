<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller;

use App\Application\Request\GetStatusRequest;
use App\Application\UseCase\GetStatusUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/status', name: 'app_get_order_status', methods: 'GET')]
class GetStatusController extends AbstractController
{
    public function __construct(
        private readonly GetStatusUseCase $statusUseCase,
    ) {
    }

    public function __invoke(
        #[MapQueryString(validationFailedStatusCode: Response::HTTP_BAD_REQUEST)] GetStatusRequest $request
    ): JsonResponse {
        $result = ($this->statusUseCase)($request);

        return $this->json($result);
    }
}
