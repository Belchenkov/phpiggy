<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\AboutController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use Framework\App;

function registerRoutes(App $app): void
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [AuthController::class, 'registerForm']);
    $app->get('/login', [AuthController::class, 'loginForm']);
    $app->post('/register', [AuthController::class, 'registerStore']);
    $app->post('/login', [AuthController::class, 'loginStore']);
}
