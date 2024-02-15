<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;

class User extends DbModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function register()
    {
        return $this->save();
    }

    public function tableName(): string
    {
        return 'tblClients';
    }
    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'birthdate','password'];
    }
    public function datatypes(): array
    {
        return ['s', 's', 's', 's', 's'];
    }

    public function rules(): array
    {
    return [
        'firstname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max'=>255]],
        'lastname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max'=>255]],
        'email' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max'=>255], self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'email']],
        'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max'=>24]],
        'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
    ];
}
}