<?php

namespace Mubangizi\Models;

use Mubangizi\Core\Model;

class Contact extends Model
{
    public $email;
    public $subject;
    public $message;
    
    public function rules(): array
    {
        return  [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'subject' => [self::RULE_REQUIRED, self::RULE_MIN => 3, self::RULE_MAX => 150],
            'message' => [self::RULE_REQUIRED, self::RULE_MIN => 50, self::RULE_MAX => 500]];
    }
}
