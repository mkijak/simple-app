<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Command;
use App\Application\CommandHandler;
use App\Application\Exception\ApplicationError;
use App\Application\Exception\InvalidInput;
use App\Domain\User;
use App\Domain\Users;

class RegisterUser implements CommandHandler
{
    public function __construct(
        private Users $users,
    ) {
    }

    public function handle(Command $command): void
    {
        if(!$command instanceof Command\RegisterUser) {
            throw new ApplicationError(sprintf('Command [%s] is not supported by [%s]',
                                               get_class($command), self::class));
        }

        if($this->users->findByEmail($command->email())) {
            throw new InvalidInput(sprintf('E-mail address %s is already in use', $command->email()));
        }

        try {
            $this->users->add(User::create($command->email(), $command->password()));
        } catch (\DomainException $exception) {
            throw new InvalidInput($exception->getMessage());
        } catch (\Throwable $exception) {
            throw new ApplicationError($exception->getMessage());
        }
    }

    public static function getName(): string
    {
        return self::class;
    }
}
