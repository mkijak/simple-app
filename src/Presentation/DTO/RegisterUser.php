<?php

declare(strict_types=1);

namespace App\Presentation\DTO;

use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser
{
    /**
     * @Assert\NotNull()
     * @Assert\Email()
     * @OA\Property(
     *     description="User email",
     *     type="string",
     *     example="mail@domain.com",
     *     nullable=false
     * )
     * @var string
     */
    private string $email;
    /**
     * @Assert\NotNull()
     * @Assert\NotCompromisedPassword()
     * @OA\Property(
     *     description="User password",
     *     type="string",
     *     example="zxasqw12",
     *     nullable=false
     * )
     * @var string
     */
    private string $password;

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
