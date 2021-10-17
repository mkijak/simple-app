<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Exception\ApplicationError;

class SimpleCommandHandlerLocator implements CommandHandlerLocator
{
    private const CH_NAMESPACE = 'App\Application\CommandHandler';

    public function __construct(
        private iterable $handlers,
    ) {
    }

    public function getHandler(Command $command): CommandHandler
    {
        $class = sprintf('%s\%s', self::CH_NAMESPACE, (new \ReflectionClass($command))->getShortName());

        foreach ($this->handlers as $handler) {
            if ($handler instanceof $class) {
                return $handler;
            }
        }

        throw new ApplicationError(sprintf('Cannot locate handler for [%s]', get_class($command)));
    }
}
