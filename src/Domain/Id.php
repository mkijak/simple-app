<?php

declare(strict_types=1);

namespace App\Domain;

final class Id implements \Stringable
{
    private string $id;

    public function __construct()
    {
        $this->id = (string) new \MongoId();
    }

    public function __toString()
    {
        return $this->id;
    }
}
