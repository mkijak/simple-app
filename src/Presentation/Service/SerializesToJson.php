<?php

declare(strict_types=1);

namespace App\Presentation\Service;

interface SerializesToJson
{
    public function serialize(mixed $data): string;
}
