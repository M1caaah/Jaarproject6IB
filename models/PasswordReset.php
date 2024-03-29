<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class PasswordReset extends DbModel
{
    public string $password = '';
    public string $newPassword = '';
    public string $confirmPassword = '';


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
        return ['password'];
    }

    public function datatypes(): string
    {
        return 's';
    }

    public function labels(): array
    {
        return [
            'password' => 'Old password',
            'newPassword' => 'New password',
            'confirmPassword' => 'Confirm new password'
        ];
    }

    public function rules(): array
    {
        return [
            'password' => [self::RULE_REQUIRED],
            'newPassword' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 255]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'newPassword']]
        ];
    }

    public function updatePassword()
    {
        if (!password_verify($this->password, Application::$app->user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        $this->password = password_hash($this->newPassword, PASSWORD_DEFAULT);
        $this->update(Application::$app->session->get('user'));
        return true;
    }
}