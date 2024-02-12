<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(
        private readonly Database $db,
    )
    {}

    /**
     * @param string $email
     * @return bool
     */
    public function isEmailTaken(string $email): bool
    {
        $email_count = $this->db->query("SELECT COUNT(*) FROM users WHERE email = :email", [
            'email' => $email,
        ])->count();

        if ($email_count > 0) {
            throw new ValidationException(['email' => 'Email taken!']);
        }

        return false;
    }

    public function create(array $form_data): void
    {


        $this->db->query("INSERT INTO users(email,password,age,country,social_media_url) VALUES(:email, :password, :age, :country, :social_media_url)", [
            'email' => $form_data['email'],
            'password' => password_hash($form_data['password'], PASSWORD_BCRYPT, ['cost' => 12]),
            'age' => $form_data['age'],
            'country' => $form_data['country'],
            'social_media_url' => $form_data['socialMediaURL'],
        ]);
    }
}
