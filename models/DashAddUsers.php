<?php

namespace app\models;

use app\core\DbModel;

class DashAddUsers extends DashUsers
{
    public string $regDate = '';
    public string $confirmPassword = '';

    public static function tableName(): string
    {
        return 'tblclients c, tblroles r';
    }

    public static function primaryKey(): string
    {
        return 'client_id';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', ['c', 'role_id'], 'birthdate'];
    }

    public function datatypes(): string
    {
        return 'ssssis';
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'roleName' => 'Role',
            'confirmPassword' => 'Confirm Password',
        ];
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]]
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function saveUser(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->insert(tableName: 'tblclients');
    }
}