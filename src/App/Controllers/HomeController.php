<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class HomeController
{
    public function __construct(private readonly TemplateEngine $view)
    {}

    public function home(): void
    {
        echo $this->view->render("/index.php", [
            'title' => 'Home'
        ]);
    }
}
