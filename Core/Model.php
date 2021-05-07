<?php

namespace Mubangizi\Core;

abstract class Model
{

  public $errors = [];
  public $validation_messages = [
    self::RULE_MIN => '{attribute} must be at least {rule} characters.',
    self::RULE_MAX => '{attribute} must not be more than {rule} characters.',
    self::RULE_REGEX => '{message}',
    self::RULE_MATCH => 'The {attribute} must match the {rule}.',
    self::RULE_PHONE => 'The number {value} you provided is not a valid {attribute}.',
    self::RULE_EMAIL => 'This {value} does not seem to be a valid {attribute} address.',
    self::RULE_UNIQUE => 'The {value} is already in use.',
    self::RULE_IS_FILE => '{attribute} must be part of a valid {rule} format.',
    self::RULE_REQUIRED => 'Please provide, {attribute} to proceed.',
  ];

  public const RULE_MIN = 'min';
  public const RULE_MAX = 'max';
  public const RULE_REGEX = 'regex';
  public const RULE_MATCH = 'match';
  public const RULE_PHONE = 'phone';
  public const RULE_EMAIL = 'email';
  public const RULE_IS_FILE = 'file';
  public const RULE_UNIQUE = 'unique';
  public const RULE_REQUIRED = 'required';

  public abstract function rules(): array;

  public function data($model)
  {
    foreach ($model as $key => $value) {
      if (property_exists($this, $key)) {
        $this->{$key} = filter_var($value, FILTER_SANITIZE_STRING);
      }
    }
  }

  public function is_valid()
  {
    foreach ($this->rules() as $attribute => $rules) {
      foreach ($rules as $rule_name => $rule) {
        if (is_string($rule_name)) {
          $this->check($attribute, $rule_name, $rule);
        } else {
          $this->check($attribute, $rule);
        }
      }
    }

    return empty($this->errors);
  }

  public function has_error($attribute)
  {
    return $this->errors[$attribute] ?? false;
  }

  public function add_error($attribute, $rule_name, $rule)
  {

    $message = $this->validation_messages[$rule_name] ?? '';

    switch ($rule_name) {
      case self::RULE_REGEX:
        $message = str_replace('{message}', $rule['message'], $message);
        break;
      case self::RULE_UNIQUE:
        $message = str_replace('{value}', $attribute, $message);
        break;
      default:
        if (!is_array($rule)) {
          $message = str_replace('{attribute}', str_replace('_', ' ', $attribute), $message);
          $message = str_replace('{value}', $this->{$attribute}, $message);
          $message = str_replace('{rule}', $rule, $message);
        }
        break;
    }

    $this->errors[$attribute][] = $message;
  }

  public function get_error($attribute, int|string $index = 0)
  {
    $errors = $this->errors[$attribute] ?? [];
    if ($index === 'all') {
      return $errors;
    }
    if ($index === 'last') {
      return end($errors);
    }
    if (array_key_exists($index, $errors)) {
      return $errors[$index];
    }
  }

  public function check($attribute, $rule_name, $rule = null)
  {
    $is_error = false;
    $value = $this->{$attribute};
    switch ($rule_name) {
      case self::RULE_MIN:
        $is_error = is_string($value)
          ? strlen($value) < $rule
          : $value < $rule;
        break;
      case self::RULE_MAX:
        $is_error = is_string($value)
          ? strlen($value) > $rule
          : $value > $rule;
        break;
      case self::RULE_MATCH:
        $is_error = $value !== $this->{$rule};
        break;
      case self::RULE_PHONE:
        $code = $rule['country_code'];
        $is_error = preg_match("/^((?:\+$code|$code)|0)(\d{2})[- ]?(\d{3})[- ]?(\d{4})$/", $value) === 0;
        break;
      case self::RULE_EMAIL:
        $is_error = !filter_var($value, FILTER_VALIDATE_EMAIL);
        break;
      case self::RULE_UNIQUE:
        $is_error = $rule['callback']($value);
        break;
      case self::RULE_IS_FILE:
        break;
      case self::RULE_REGEX:
        $is_error = preg_match($rule['regex'], $value) === 0;
        break;
      case self::RULE_REQUIRED:
        $is_error = $value === null || empty($value);
        break;
      default:
        break;
    }

    if ($is_error === true) {
      $this->add_error($attribute, $rule_name, $rule);
    }
    return $is_error;
  }
}
