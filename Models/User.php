<?php

namespace Mubangizi\Models;

use Mubangizi\Core\Table;

class User extends Table
{

  public $email;
  public $password;
  public $last_name;
  public $joined_at;
  public $first_name;
  public $profile_img;
  public $confirm_password;
  public int $is_active = self::STATUS_INACTIVE;

  public const STATUS_ACTIVE = 1;
  public const STATUS_INACTIVE = 0;
  public const STATUS_DEACTIVATED = -1;


  public function table_name(): string
  {
    return 'users';
  }

  public function table_columns(): array
  {
    return [
      'email',
      'joined_at',
      'last_name',
      'is_active',
      'first_name',
      'profile_img',
      ['name' => 'password_hash', 'value' => password_hash($this->password, PASSWORD_BCRYPT)],
    ];
  }

  public function rules(): array
  {
    return [
      'email' => [
        self::RULE_EMAIL,
        self::RULE_REQUIRED,
        self::RULE_UNIQUE => [
          'callback' => function ($value) {
            return $this->exists($value, 'email');
          }
        ]
      ],
      'password' => [
        self::RULE_REQUIRED,
        self::RULE_MIN => 8,
        self::RULE_MAX => 100,
        self::RULE_REGEX => [
          'message' => 'Try a stronger Password, with a number, special character and capitalized letter.',
          'regex' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[-!@#$%^&*]).{8,60}$/',
        ]
      ],
      'last_name' => [self::RULE_REQUIRED, self::RULE_MIN => 3, self::RULE_MAX => 50],
      'first_name' => [self::RULE_REQUIRED, self::RULE_MIN => 3, self::RULE_MAX => 50],
      'profile_img' => [self::RULE_IS_FILE => ['jpg', 'png', 'jpeg']],
      'confirm_password' => [self::RULE_REQUIRED, self::RULE_MATCH => 'password']
    ];
  }

  public function __toString()
  {
    return $this->first_name . ' ' . $this->last_name;
  }
}
