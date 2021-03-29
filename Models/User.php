<?php 

namespace Mubangizi\Models;

use Mubangizi\Core\Model;

class User extends Model {
  public $email;
  public $password;
  public $is_active;
  public $last_name;
  public $first_name;
  public $profile_img;
  public $confirm_password;
  
  public function rules(): array {
    return [
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'password' => [self::RULE_REQUIRED, self::RULE_MIN => 8, self::RULE_MAX => 100],
      'last_name' => [self::RULE_REQUIRED, self::RULE_MIN => 3, self::RULE_MAX => 50],
      'first_name' => [self::RULE_REQUIRED, self::RULE_MIN => 3, self::RULE_MAX => 50],
      'profile_img' => [self::RULE_IS_FILE => ['jpg', 'png', 'jpeg']],
      'confirm_password' => [self::RULE_REQUIRED, self::RULE_MATCH => 'password']
    ];
  }
  
  public function register(){
    
  }
}