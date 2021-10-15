<?php

declare(strict_types=1);

namespace App\Domain;

interface Users
{
    public function add(User $user): void;
    public function remove(User $user): void;
    public function findByEmail(string $email): ?User;
}
