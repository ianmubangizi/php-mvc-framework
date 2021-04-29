<?php

namespace Mubangizi\Core\Form;

use Mubangizi\Core\Model;

class Form
{

  protected Model $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  protected function get_value($name)
  {
    return $this->model->{$name};
  }

  protected function get_error($name)
  {
    return ucfirst($this->model->get_error($name));
  }

  protected function get_invalid($name)
  {
    return $this->model->has_error($name)
      ? 'is-invalid'
      : null;
  }

  public static function open($method, $action = '', $classes = ['py-3'])
  {
    $classes = implode(' ', $classes);
    return <<<tag
      <form method="$method" class="$classes" action="$action" >
    tag;
  }

  public static function close()
  {
    return '</form>';
  }

  public function button($text, $type, $classes = ['btn', 'btn-lg', 'btn-primary'])
  {
    $classes = implode(' ', $classes);
    return <<<tag
      <button class="$classes" type="$type">
        $text
      </button>
    tag;
  }

  public function input($label, $name, $type = 'text', string $icon = null)
  {
    return <<<tag
      <div class="form-group">
        <label for="$name">
          $label
        </label>
        {$this->input_group($type,$name,$icon)}
      </div>
    tag;
  }

  protected function input_group($type, $name, $icon)
  {
    $classes = implode(' ', ['form-control', $this->get_invalid($name)]);
    $input = <<<input
      <input
        name="$name"
        type="$type"
        value="{$this->get_value($name)}"
        class="$classes">
      <div class="invalid-feedback">
        {$this->get_error($name)}
      </div> 
    input;

    return $icon !== null ? <<<tag
      <div class="input-group has-validation">
        <div class="input-group-text">
          <i class="fa fa-$icon"></i>
        </div>
        $input
      </div>
    tag : $input;
  }

  public function textarea($label, $name, $placeholder = '')
  {
    $classes = implode(' ', ['form-control', $this->get_invalid($name)]);
    return <<<textarea
      <div class="form-group">
          <label for="$name">
            $label
          </label>
          <div class="input-group has-validation">
            <textarea name="$name" 
              class="$classes"
              placeholder="$placeholder">{$this->get_value($name)}</textarea>
            <div class="invalid-feedback">
              {$this->get_error($name)}
            </div> 
          </div>
        </div>
    textarea;
  }
}
