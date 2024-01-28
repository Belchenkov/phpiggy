<?php

declare(strict_types=1);

use App\Config\Paths;
use App\Services\ValidatorService;
use Framework\TemplateEngine;

return [
    ValidatorService::class => fn () => new ValidatorService(),
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
];
