<?php

declare(strict_types=1);

namespace App\Presentation\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

interface GeneratesJsonResponse
{
    public function created(): JsonResponse;
    public function badRequest(string $errorMsg): JsonResponse;
    public function serverError(string $errorMsg): JsonResponse;
}
