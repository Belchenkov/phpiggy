<?php

declare(strict_types=1);

namespace App\Controllers;

class AuthController extends BaseController
{

    public function registerForm(): void
    {
        echo $this->view->render("/register.php", [
            'title' => 'Register'
        ]);
    }

    public function registerStore(): void
    {

    }
}
