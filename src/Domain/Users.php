<?php

declare(strict_types=1);

namespace App\Domain;

interface Users
{
    public function findByEmail(string $email): ?User;
}
