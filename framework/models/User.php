<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;
use app\core\UserModel;

class User extends UserModel
{
    public int $client_id = 0;
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $birthdate = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return $this->save();
    }

    public static function tableName(): string
    {
        return 'tblClients';
    }
    public static function primaryKey(): string
    {
        return 'client_id';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'birthdate','password'];
    }
    public function datatypes(): array
    {
        return ['s', 's', 's', 's', 's'];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'birthdate' => 'Date of birth',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
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

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}