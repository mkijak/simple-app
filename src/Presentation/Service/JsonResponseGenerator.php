<?php

declare(strict_types=1);

namespace App\Presentation\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseGenerator implements GeneratesJsonResponse
{
    public function __construct(
        private SerializesToJson $serializer
    ) {
    }

    public function created(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    public function badRequest(string $errorMsg): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize($this->error($errorMsg)),
            Response::HTTP_BAD_REQUEST,
            [],
            true,
        );
    }

    public function serverError(string $errorMsg): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize($this->error($errorMsg)),
            Response::HTTP_INTERNAL_SERVER_ERROR,
            [],
            true,
        );
    }

    private function error(string $msg): array
    {
        return [
            'error'=> $msg,
        ];
    }
}
