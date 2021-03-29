<?php

namespace Mubangizi\Core\Form;

use Mubangizi\Core\Model;

class Form {
  
  protected Model $model;
  
  public function __construct(Model $model){
    $this->model = $model;
  }
  
  public static function open($method, $action = '', $classes = 'py-3'){
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
  
  public function button($type, $text){
return <<<tag
    <button 
      class="btn btn-md btn-primary"
      type="type">
        $text
    </button>
tag;
  }
  
  public function input($type, $name, $label){
    $value = $this->model->{$name};
    $is_invalid = $this->model->has_error($name) 
      ? ' is-invalid' 
      : '';
return <<<tag
<div class="form-group">
  <label for="$name">
    $label
  </label>
  <input 
    name="$name"
    type="$type"
    value="$value"
    class="form-control$is_invalid">
  <div class="invalid-feedback">
    {$this->model->get_error($name)}
  </div>
</div>
tag;
  }
  
  public function input_with_icon(){
return <<<tag
    <div class="form-group">
      <label for="email">
        Email
      </label>
      <div class="input-group">
        <div class="input-group-text">
          <i class="fa fa-envelope"></i>
        </div>
        <input 
          name="email" 
          type="email" 
          class="form-control">
      </div>
    </div>
tag;
  }
} 