<?php

declare(strict_types=1);

namespace App\Application;

class SimpleCommandBus implements CommandBus
{
    public function __construct(
        private CommandHandlerLocator $commandHandlerLocator,
    ) {
    }

    public function dispatch(Command $command): void
    {
        $this->commandHandlerLocator->getHandler($command)->handle($command);
    }
}
