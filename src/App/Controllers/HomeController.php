<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController extends BaseController
{

    public function home(): void
    {
        echo $this->view->render("/index.php", [
            'title' => 'Home'
        ]);
    }
}
