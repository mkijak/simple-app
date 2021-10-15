<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

(new Dotenv())->loadEnv(dirname(__DIR__).'/.env');

if (is_readable(dirname(__DIR__).'/.env.test.local')) {
    (new Dotenv())->overload(dirname(__DIR__).'/.env.test.local');
}
