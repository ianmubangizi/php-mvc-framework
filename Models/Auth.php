<?php

namespace Mubangizi\Models;

use Mubangizi\Core\Model;

class Auth extends Model
{
    public $email;
    public $password;

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
    }
}
