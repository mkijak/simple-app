<?php

declare(strict_types=1);

namespace App\Presentation\Service;

use App\Presentation\Exception\InvalidDto;

interface ProvidesApiModels
{
    /**
     * @throws InvalidDto
     */
    public function load(string $body, string $class): ?object;
}
