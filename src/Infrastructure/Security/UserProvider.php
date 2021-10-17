<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use App\Domain\Users;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct(
        private Users $users,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function loadUserByIdentifier(string $identifier): User
    {
        if ($user = $this->users->findByEmail($identifier)) {
            return new User($user);
        }

        throw new UserNotFoundException('User not found');
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user): User
    {
        if (!$user = $this->users->findByEmail($user->getUserIdentifier())) {
            throw new UserNotFoundException();
        }

        return new User($user);
    }

    /**
     * @inheritDoc
     */
    public function supportsClass($class): bool
    {
        return $class === User::class;
    }

    /**
     * @deprecated since symfony 5.3, added only for interface-compatibility (UserProviderInterface)
     * @inheritDoc
     */
    public function loadUserByUsername(string $username)
    {
        return $this->loadUserByIdentifier($username);
    }
}
