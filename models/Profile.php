<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class Profile extends DbModel
{

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';

    public function getUserData()
    {
        $id = Application::$app->session->get('user');
        return $this->select($this->attributes(), self::primaryKey()."  = $id");
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
        return ['firstname', 'lastname', 'email', 'password'];
    }

    public function datatypes(): array
    {
        return ['s', 's', 's', 's'];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 255]],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 255]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
        ];
    }
}