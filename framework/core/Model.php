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

                if ($ruleCode === self::RULE_REQUIRED && empty($value))
                {
                    echo "$attribute has failed required check value: $value";
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleCode === self::RULE_EMAIL && filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    echo "$attribute has failed email check value: $value";
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleCode === self::RULE_MIN && strlen($value) < $rule['min'])
                {
                    echo "$attribute has failed min check value: $value";
                    $this->addError($attribute, self::RULE_MIN);
                }
                if ($ruleCode === self::RULE_MAX && strlen($value) > $rule['max'])
                {
                    echo "$attribute has failed min check value: $value";
                    $this->addError($attribute, self::RULE_MAX);
                }
            }
        }
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