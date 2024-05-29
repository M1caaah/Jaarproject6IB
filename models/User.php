<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\core\UserModel;

class User extends UserModel
{
    public int $client_id = 0;
    public int $role_id = 0;
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $birthdate = '';
    public string $password = '';
    public string $regDate = '';
    public string $confirmPassword = '';

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->regDate = date('Y-m-d');
        // Returns true if successful
        return $this->insert();
    }

    public static function tableName(): string
    {
        return 'tblclients';
    }
    public static function primaryKey(): string
    {
        return 'client_id';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'birthdate','password', 'regDate'];
    }
    public function datatypes(): string
    {
        return 'ssssss';
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
        'birthdate' => [self::RULE_REQUIRED, self::RULE_BDATE],
        'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max'=>24]],
        'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
    ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getOrders()
    {
        return $this->select(['*'], "client_id = $this->client_id", tableName: "tblorders", checkActive: false);
    }
}