<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Exception\ApplicationError;
use App\Application\Exception\InvalidInput;

interface CommandHandler
{
    /**
     * @throws ApplicationError
     * @throws InvalidInput
     */
    public function handle(Command $command): void;
    public static function getName(): string;
}
