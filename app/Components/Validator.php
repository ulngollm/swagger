<?php

class Validator
{
    public array $errors;
    public array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
        $this->errors = [];
    }

    public function validate(mixed $value = null)
    {
        foreach ($this->rules as $rule) {
            try {
                $rule->execute($value);
            } catch (Exception $e) {
                $this->errors[] = $e->getMessage();
                break;
            }
            if ($value == null) {
                break;
            }
        }
    }
}