<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use Framework\TemplateEngine;

class ReceiptController
{
    public function __construct(
        private readonly TemplateEngine $view,
        private readonly TransactionService $transactionService,
    ) {
    }

    public function uploadView(array $params): void
    {
        $transaction = $this->transactionService->getUserTransaction($params['transaction']);

        if (!$transaction) {
            redirectTo("/");
        }

        echo $this->view->render("receipts/create.php");
    }

    public function upload(array $params): void
    {
        $transaction = $this->transactionService->getUserTransaction($params['transaction']);

        if (!$transaction) {
            redirectTo("/");
        }

        redirectTo("/");
    }
}
