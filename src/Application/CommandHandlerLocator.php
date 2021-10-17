<?php

declare(strict_types=1);

namespace App\Application;

interface CommandHandlerLocator
{
    public function getHandler(Command $command): CommandHandler;
}
