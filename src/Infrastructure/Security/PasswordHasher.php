<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use App\Domain\HashedPassword;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class PasswordHasher implements PasswordHasherInterface
{
    /**
     * @inheritDoc
     */
    public function hash(string $plainPassword): string
    {
        return (string) HashedPassword::fromPlainPassword($plainPassword);
    }

    /**
     * @inheritDoc
     */
    public function verify(string $hashedPassword, string $plainPassword): bool
    {
        return HashedPassword::fromHash($hashedPassword)->equals($plainPassword);
    }

    /**
     * @inheritDoc
     */
    public function needsRehash(string $hashedPassword): bool
    {
        return false;
    }
}
