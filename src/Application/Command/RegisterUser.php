<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Command;

class RegisterUser implements Command
{
    public function __construct(
        private string $email,
        private string $password,
    ) {
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
