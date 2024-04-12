<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_BDATE = 'bdate';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_UNIQUE_UPDATE = 'uniqueUpdate';

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

                if ($ruleCode === self::RULE_REQUIRED && !$value && $value !== '0')
                {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                if ($ruleCode === self::RULE_BDATE && strtotime($value) > time())
                {
                    $this->addErrorForRule($attribute, self::RULE_BDATE);
                }
                if ($ruleCode === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                if ($ruleCode === self::RULE_MIN && strlen($value) < $rule['min'])
                {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleCode === self::RULE_MAX && strlen($value) > $rule['max'])
                {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleCode === self::RULE_MATCH && $value !== $this->{$rule['match']})
                {
                    $rule['match'] = $this->getLabel($rule['match']);
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleCode === self::RULE_UNIQUE)
                {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = ? AND `active` = 1");
                    $statement->bind_param('s', $value);
                    $statement->execute();
                    $record = $statement->get_result()->fetch_assoc();
                    if ($record)
                    {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
                if ($ruleCode === self::RULE_UNIQUE_UPDATE)
                {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $id = $rule['id'];
                    $primaryKey = $className::primaryKey();
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = ? AND ".$primaryKey." != ?");
                    $statement->bind_param('si', $value, $id);
                    $statement->execute();
                    $record = $statement->get_result()->fetch_assoc();
                    if ($record)
                    {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE_UPDATE, ['field' => $attribute]);
                    }
                }
            }
        }
        if (!empty($this->errors))
            return $this->errors;
        return true;
    }

    public function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $param)
        {
            $message = str_replace("{{$key}}", $param, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_BDATE => 'Date cannot be in the future',
            self::RULE_EMAIL => 'This field must be a valid email adress',
            self::RULE_MIN => 'Minimum length of this field bust be {min}',
            self::RULE_MAX => 'Maximum length of this field bust be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => '{field} already exists',
            self::RULE_UNIQUE_UPDATE => '{field} already exists'
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }

    public function getLabel(string $attribute): string
    {
        return $this->labels()[$attribute] ?? $attribute;
    }
}