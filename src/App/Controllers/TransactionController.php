<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ValidatorService;
use Framework\TemplateEngine;

class TransactionController
{
    public function __construct(
        private readonly TemplateEngine $view,
        private readonly ValidatorService $s_validator
    )
    {}

    public function createView(): void
    {
        echo $this->view->render("transactions/create.php", [
            'title' => 'Create Transaction'
        ]);
    }

    public function createStore(): void
    {
        $this->s_validator->validateTransaction($_POST);
    }
}
