<?php

declare(strict_types=1);

namespace App\Controllers;

class AboutController extends BaseController
{

    public function about(): void
    {
        echo $this->view->render("/about.php", [
            'title' => 'About'
        ]);
    }
}
