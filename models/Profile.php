<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class Profile extends DbModel
{

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $birthdate = '';

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
        return ['firstname', 'lastname', 'email', 'birthdate'];
    }

    public function datatypes(): string
    {
        return 'ssss';
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'birthdate' => 'Birthdate'
        ];
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 255]],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 255]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE_UPDATE, 'class' => self::class, 'id' => Application::$app->session->get('user')]],
            'birthdate' => [self::RULE_REQUIRED],
        ];
    }

    public function updateInfo()
    {
        $id = Application::$app->session->get('user');

        return true;
    }
}