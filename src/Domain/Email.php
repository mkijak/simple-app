<?php

declare(strict_types=1);

namespace App\Domain;

final class Email implements \Stringable
{
    public function __construct(
        private string $email,
    ) {
        $this->validateEmail();
    }

    private function validateEmail()
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException(sprintf('"%s" is not a valid e-mail address', $this->email));
        }
    }

    public function __toString()
    {
        return $this->email;
    }
}
