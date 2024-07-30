<?php

declare(strict_types=1);

namespace App\Infrastructure\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Throwable;

class ExceptionListener
{
    public function __construct(
        private readonly string $env,
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($this->env === 'dev') {
            return;
        }

        if ($exception->getPrevious() instanceof ValidationFailedException) {
            $response = $this->getWrongValidationResponse($exception->getPrevious());
            $event->setResponse($response);
            return;
        }

        $response = $this->getDefaultProdResponse($exception);
        $event->setResponse($response);
    }

    private function getWrongValidationResponse(ValidationFailedException $exception): JsonResponse
    {
        $errors = [];
        foreach ($exception->getViolations() as $violation) {
            $errors[] = [
                'name' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }

        return new JsonResponse(
            [
                'title' => 'Некорректные данные запроса',
                'errors' => $errors,
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    private function getDefaultProdResponse(Throwable $throwable): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => $throwable->getMessage(),
            ],
            Response::HTTP_BAD_REQUEST
        );
    }
}
