<?php

namespace Mubangizi\Core\Form;

use Mubangizi\Core\Model\Model;

class Form
{
  public Field $field;
  protected Model $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
    $this->field = new Field($model);
  }

  public static function open($method, $action = '', $classes = ['py-3'])
  {
    $classes = implode(' ', $classes);
    return <<<tag
      <form method="$method" class="$classes" action="$action">
    tag;
  }

  public static function close()
  {
    return '</form>';
  }
}
