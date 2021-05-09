<?php

namespace Mubangizi\Models;

use Mubangizi\Core\Model\Model;

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
            'message' => [self::RULE_REQUIRED, self::RULE_MIN => 50, self::RULE_MAX => 500]
        ];
    }

    public function send()
    {
        $this->clear();
        return true;
    }

    protected function clear()
    {
        $this->email = '';
        $this->subject = '';
        $this->message = '';
    }
}
