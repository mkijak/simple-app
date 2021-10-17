<?php

declare(strict_types=1);

namespace App\Presentation\Service;

interface DeserializesJson
{
    public function deserialize(string $json, string $type): mixed;
}
