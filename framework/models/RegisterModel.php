<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $confirmPassword;

    public function register()
    {
        echo 'registered new user';
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max'=>255]],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max'=>255]],
            'email' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max'=>255], self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max'=>255]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}