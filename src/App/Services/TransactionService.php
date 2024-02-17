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

    public function getUserTransactions(): bool | array
    {
        $search = addcslashes($_GET['s'] ?? '', '%_');

        return $this->db->query(
            "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date FROM transactions WHERE user_id = :user_id AND description LIKE :description",
            [
                'user_id' => $_SESSION['user'],
                'description' => "%$search%",
            ]
        )->findAll();
    }
}
