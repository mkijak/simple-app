<?php

declare(strict_types=1);

namespace App\Domain;

class User
{
    private string $id;
    private Email $email;
    private HashedPassword $password;

    public static function create(
        string $email,
        string $password,
    ): User {
        $user = new self();

        $user->id = (string) new Id();
        $user->email = new Email($email);
        $user->password = HashedPassword::fromPlainPassword($password);

        return $user;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): HashedPassword
    {
        return $this->password;
    }

    public function updatePassword(string $plainPassword)
    {
        $this->password = HashedPassword::fromPlainPassword($plainPassword);
    }
}
