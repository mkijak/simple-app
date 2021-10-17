<?php

declare(strict_types=1);

namespace App\Presentation\Service;

use App\Presentation\Exception\InvalidDto;

interface ValidatesApiDto
{
    /**
     * @throws InvalidDto
     */
    public function validate(object $dto): void;
}
