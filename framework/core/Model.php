<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 0;
    public const RULE_EMAIL = 1;
    public const RULE_MIN = 2;
    public const RULE_MAX = 3;
    public const RULE_MATCH = 4;

    public array $errors = [];

    abstract public function rules(): array;

    public function loadData($data)
    {
        foreach ($data as $key => $value)
        {
            if (property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleCode = $rule;
                if (!is_int($ruleCode))
                {
                    $ruleCode = $rule[0];
                }
                if ($ruleCode === self::RULE_REQUIRED && !$value)
                {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule)
    {
        $message = $this->errorMessages()[$rule] ?? '';
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email adress',
            self::RULE_MIN => 'Minimum length of this field bust be {min}',
            self::RULE_MAX => 'Maximum length of this field bust be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}'
        ];
    }
}