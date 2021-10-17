<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, EquatableInterface, PasswordHasherAwareInterface
{
    public function __construct(
        private \App\Domain\User $user
    ) {
    }

    /********************** UserInterface ********************/

    /**
     * @inheritDoc
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return (string) $this->user->password();
    }

    /**
     * @inheritDoc
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->user->email();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
        //plain password is not being stored in memory
    }

    /********************** EquatableInterface ********************/

    public function isEqualTo(UserInterface $user): bool
    {
        return $this->getUserIdentifier() === $user->getUserIdentifier()
            && $this->getPassword() === $user->getPassword()
            && $this->getSalt() === $user->getSalt();
    }

    /******************** PasswordHasherAwareInterface ********************/

    /**
     * @inheritDoc
     */
    public function getPasswordHasherName(): string
    {
        return PasswordHasher::class;
    }

    public function getUser(): \App\Domain\User
    {
        return $this->user;
    }

    /**
     * @deprecated since symfony 5.3, added only for interface-compatibility (UserInterface)
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }
}
