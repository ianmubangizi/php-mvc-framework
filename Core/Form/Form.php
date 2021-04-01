<?php

namespace Mubangizi\Core\Form;

use Mubangizi\Core\Model;

class Form {
  
  protected Model $model;
  
  public function __construct(Model $model){
    $this->model = $model;
  }
  
  public static function open($method, $action = '', $classes = ['py-3']){
  $classes = implode(' ', $classes);
return <<<tag
<form
 method="$method"
 class="$classes"
 action="$action"
>
tag;
  }
  
  public static function close(){
    return '</form>';
  }
  
  public function button($text, $type, $classes = ['btn', 'btn-md', 'btn-primary']){
    $classes = implode(' ', $classes);
return <<<tag
  <button 
    class="$classes"
    type="type">
    $text
  </button>
tag;
  }
  
  public function input($label, $name, $type = 'text', string $icon = null){
return <<<tag
<div class="form-group">
  <label for="$name">
    $label
  </label>
  {$this->_input($type, $name, $icon)}
</div>
tag;
  }
  
  public function _input($type, $name, $icon){
    $value = $this->model->{$name};
    $is_invalid = $this->model->has_error($name) 
      ? 'is-invalid' 
      : null;
    $classes = implode(' ', ['form-control', $is_invalid]);
    $input = <<<input
<input
  name="$name"
  type="$type"
  value="$value"
  class="$classes">
<div class="invalid-feedback">
  {$this->model->get_error($name)}
</div> 
input;

return $icon !== null
? <<<tag
<div class="input-group has-validation">
  <div class="input-group-text">
    <i class="fa fa-$icon"></i>
  </div>
  $input
</div>
tag
: $input;
  }
} 