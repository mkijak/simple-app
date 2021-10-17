<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Exception\ApplicationError;
use App\Application\Exception\InvalidInput;

interface CommandBus
{
    /**
     * @throws ApplicationError
     * @throws InvalidInput
     */
    public function dispatch(Command $command): void;
}
