<?php

namespace app\models;

use app\core\DbModel;

class DashEditUsers extends DashUsers
{
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
        return ['firstname', 'lastname', 'email', 'birthdate', ['c', 'role_id']];
    }

    public function datatypes(): string
    {
        return 'sssiss';
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'role_id' => 'Role',
            'newPassword' => 'New Password'
        ];
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE_UPDATE, 'class' => self::class, 'id' => $this->client_id]],
            'role_id' => [self::RULE_REQUIRED]
        ];
    }


    public function getUserData(): array
    {
        $attributes = $this->attributes();
        array_push($attributes, "roleName", "regDate");
        return $this->select($attributes, self::primaryKey() . " = $this->client_id AND c.role_id = r.role_id", tableName: "tblclients c, tblroles r")[0];
    }

    public function updateUser(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $attributes = $this->attributes();
        $attributes[] = "password";
        $attributes = $this->processAliases($attributes, false);
        return $this->update($this->client_id, $attributes);
    }


}