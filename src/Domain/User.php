<?php

declare(strict_types=1);

namespace App\Domain;

final class User
{
    private Id $id;
    private Email $email;
    private HashedPassword $password;

    public static function create(
        string $email,
        string $password,
    ): User {
        $user = new self();

        $user->id = new Id();
        $user->email = new Email($email);
        $user->password = new HashedPassword($password);

        return $user;
    }
}
