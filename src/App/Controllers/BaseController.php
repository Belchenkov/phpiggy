<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class BaseController
{
    public function __construct(
        protected TemplateEngine $view,
    )
    {}
}
