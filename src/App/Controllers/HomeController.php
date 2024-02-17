<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use Framework\TemplateEngine;

class HomeController
{
    public function __construct(
        private readonly TemplateEngine $view,
        private readonly TransactionService $s_transaction,
    )
    {}

    public function home(): void
    {
        echo $this->view->render("/index.php", [
            'title' => 'Home',
            'transactions' => $this->s_transaction->getUserTransactions(),
        ]);
    }
}
