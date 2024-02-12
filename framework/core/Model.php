<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

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
        foreach ($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach ($rules as $rule)
            {
                $ruleCode = $rule;
                if (!is_string($ruleCode))
                {
                    $ruleCode = $rule[0];
                }

                if ($ruleCode === self::RULE_REQUIRED && !$value)
                {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleCode === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleCode === self::RULE_MIN && strlen($value) < $rule['min'])
                {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleCode === self::RULE_MAX && strlen($value) > $rule['max'])
                {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleCode === self::RULE_MATCH && $value !== $this->{$rule['match']})
                {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
        echo empty($this->errors);
        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $param)
        {
            $message = str_replace("{{$key}}", $param, $message);
        }
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