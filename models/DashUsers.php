<?php

namespace app\models;

use app\core\DbModel;

class DashUsers extends DbModel
{
    public string $client_id = '';
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $role_id = '';

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
        return ['firstname', 'lastname', 'email', 'password', "c.role_id"];
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
            'password' => 'Password',
            'role_id' => 'Role'
        ];
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]]
        ];
    }

    public function countUsers()
    {
        $sql = "SELECT COUNT(*) FROM tblclients WHERE active = 1";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return (int)$result['COUNT(*)'];
    }

    public function getUserData()
    {
        return $this->select($this->attributes(), self::primaryKey(). " = $this->client_id AND c.role_id = r.role_id")[0];
    }

    public function getDisplayName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}