<?php

declare(strict_types=1);

namespace App\Config;

use App\Middleware\TemplateDataMiddleware;
use App\Middleware\ValidationExceptionMiddleware;
use Framework\App;

function registerMiddleware(App $app): void
{
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
}
