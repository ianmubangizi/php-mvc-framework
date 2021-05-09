<?php

namespace Mubangizi\Core\Model;

use Mubangizi\Core\Application;
use Mubangizi\Core\Session;

class Auth extends Table
{
    public $email;
    public $password;


    public static function table_name(): string
    {
        return Application::$app::$auth_table;
    }

    public function login(): bool
    {
        $user = self::where(['email' => $this->email]);
        if ($user && password_verify($this->password, $user->password_hash)) {
            Session::set('auth', [
                'id' => $user->id,
                'email' => $user->email,
                'full-name' => "$user->first_name $user->last_name"
            ]);
            return true;
        }
        return false;
    }

    public static function is_guest(): bool
    {
        return Application::$app->auth === null;
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function table_columns(): array
    {
        return [
            'email',
            'password_hash',
        ];
    }
}
