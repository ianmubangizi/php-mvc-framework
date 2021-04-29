<?php

namespace Mubangizi\Models;

use Mubangizi\Core\Table;

class User extends Table
{
  public $email;
  public $password;
  public $is_active;
  public $last_name;
  public $first_name;
  public $profile_img;
  public $confirm_password;

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
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
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
}
