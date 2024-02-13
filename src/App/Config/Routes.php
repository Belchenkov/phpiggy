<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\AboutController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Middleware\AuthRequiredMiddleware;
use App\Middleware\GuestOnlyMiddleware;
use Framework\App;

function registerRoutes(App $app): void
{
    $app->get('/', [HomeController::class, 'home'])->middleware(AuthRequiredMiddleware::class);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [AuthController::class, 'registerForm'])->middleware(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginForm'])->middleware(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'registerStore'])->middleware(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'loginStore'])->middleware(GuestOnlyMiddleware::class);
}
