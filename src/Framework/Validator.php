<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

class Validator
{
    private array $rules = [];

    public function add(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validate(array $form_data, array $fields): void
    {
        $errors = [];

        foreach ($fields as $field => $rules) {
            foreach ($rules as $rule) {
                $rule_validator = $this->rules[$rule];

                if ($rule_validator->validate($form_data, $field, [])) {
                    continue;
                }

                $errors[$field][] = $rule_validator->getMessage($form_data, $field, []);
            }
        }

        if (count($errors)) {
            throw new ValidationException($errors);
        }
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        // TODO: Implement getMessage() method.
    }
}
