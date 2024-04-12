<?php

namespace app\models;

use app\core\DbModel;

class DashUsers extends DbModel
{
    public string $client_id = '';
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $birthdate = '';
    public string $role_id = '';
    public string $roleName = '';
    public string $password = '';


    public function getDisplayName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

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
        return ['firstname', 'lastname', 'email', 'password', ['c', 'role_id'], 'birthdate', 'regDate', 'roleName'];
    }

    public function datatypes(): string
    {
        return 'ssssisss';
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
        return [];
    }

    public function countUsers()
    {
        $sql = "SELECT COUNT(*) FROM tblclients WHERE active = 1";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return (int)$result['COUNT(*)'];
    }

    public function getRecentUsers($limit = 5)
    {
        return $this->select($this->attributes(), "c.role_id = r.role_id", "client_id DESC", $limit);
    }

}