<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\{RequiredRule, EmailRule, MinRule};
use Framework\Validator;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('min', new MinRule());
    }

    public function validateRegister(array $form_data): void
    {
        $this->validator->validate($form_data, [
            'email' => ['required', 'email'],
            'age' => ['required', 'min:18'],
            'country' => ['required'],
            'socialMediaURL' => ['required'],
            'password' => ['required'],
            'confirm' => ['required'],
            'accept' => ['required'],
        ]);
    }
}
