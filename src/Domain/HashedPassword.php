<?php

declare(strict_types=1);

namespace App\Domain;

final class HashedPassword implements \Stringable
{
    private string $hash;

    public static function fromPlainPassword(string $plainPassword): HashedPassword
    {
        if(!$plainPassword) {
            throw new \DomainException('Password cannot be empty');
        }

        $pass = new self();
        $pass->hash = self::hash($plainPassword);

        return $pass;
    }

    public static function fromHash(string $hash): HashedPassword
    {
        $pass = new self();
        $pass->hash = $hash;

        return $pass;
    }

    public function equals(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hash);
    }

    public function __toString(): string
    {
        return $this->hash;
    }

    private static function hash(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_ARGON2I);
    }
}
