<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(
        private readonly Database $db,
    )
    {}

    public function create(array $form_data): void
    {
        $this->db->query(
    "INSERT INTO transactions(user_id, description, amount, date) VALUES(:user_id, :description, :amount, :date)",
          [
              'user_id' => $_SESSION['user'],
              'description' => $form_data['description'],
              'amount' => $form_data['amount'],
              'date' => "{$form_data['date']} 00:00:00",
          ]
        );
    }
}
