<?php

declare(strict_types=1);

namespace App\Domain;

final class HashedPassword implements \Stringable
{
    private string $hash;

    public function __construct(
        string $password,
    ) {
        if(!$password) {
            throw new \DomainException('Password cannot be empty');
        }

        $this->hash = $this->hash($password);
    }

    public function equals(string $plainPassword): bool
    {
        return $this->hash === $this->hash($plainPassword);
    }

    public function __toString(): string
    {
        return $this->hash;
    }

    private function hash(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_ARGON2I);
    }
}
