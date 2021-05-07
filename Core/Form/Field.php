<?php


namespace Mubangizi\Core\Form;

use Mubangizi\Core\Model;
use Mubangizi\Core\Widget\Form\Attributable;
use Mubangizi\Core\Widget\Form\Button;
use Mubangizi\Core\Widget\Form\Input;
use Mubangizi\Core\Widget\Form\TextArea;
use Mubangizi\Core\Widget\Widget;

class Field extends Widget implements Button, Input, TextArea
{

  protected Model $model;

  public function __construct(Model &$model)
  {
    $this->model = $model;
  }

  public function button(string $text): Button
  {
    $button = new Field($this->model);
    $button->type = 'submit';
    $button->classes = ['btn', 'btn-lg', 'btn-primary'];
    $button->html = function () use (&$button, &$text) {
      $button->styles = implode(' ', $button->classes);
      return <<<button
        <button class="$button->styles" type="$button->type">
          $text
        </button>
        button;
    };
    return $button;
  }

  public function input($label): Input
  {
    $input = new Field($this->model);
    $input->type = 'text';
    $input->html = fn () => <<<tag
      <div class="form-group">
        <label for="$input->name">
          $label
        </label>
        {$this->base_input($input)}
      </div>
    tag;
    return $input;
  }

  protected function base_input(Field &$input)
  {
    $input->classes = ['form-control', $input->invalid($input->name)];
    $input->styles = implode(' ', $input->classes);
    $html = <<<input
      <input
        name="$input->name"
        type="$input->type"
        value="{$input->value($input->name)}"
        class="{$input->styles}">
      <div class="invalid-feedback">
        {$input->error($input->name)}
      </div> 
    input;

    $html = $input->icon !== null ? <<<tag
      <div class="input-group has-validation">
        <div class="input-group-text">
          <i class="fa fa-{$input->icon}"></i>
        </div>
        $html
      </div>
    tag : $html;

    return $html;
  }

  public function textarea($label): TextArea
  {
    $textarea = new Field($this->model);
    $textarea->classes = ['form-control', $textarea->invalid($textarea->name)];
    $textarea->html = function () use (&$textarea, &$label) {
      $textarea->styles = implode(' ', $textarea->classes);
      return <<<textarea
        <div class="form-group">
            <label for="$textarea->name">
              $label
            </label>
            <div class="input-group has-validation">
              <textarea name="$textarea->name" 
                class="$textarea->styles"
                placeholder="$textarea->placeholder">{$textarea->value($textarea->name)}</textarea>
              <div class="invalid-feedback">
                {$textarea->error($textarea->name)}
              </div> 
            </div> 
        </div>
      textarea;
    };
    return $textarea;
  }

  public function onclick($callback): Attributable
  {
    return $this;
  }

  public function placeholder(string $text): Attributable
  {
    $this->placeholder = $text;
    return $this;
  }

  public function type(string $is): Attributable
  {
    $this->type = $is;
    return $this;
  }

  public function name(string $is): Attributable
  {
    $this->name = $is;
    return $this;
  }

  public function icon(string $is): Attributable
  {
    $this->icon = $is;
    return $this;
  }

  public function css(array $classes): Attributable
  {
    $this->classes = $classes;
    return $this;
  }

  public function onchange($callback): Attributable
  {
    return $this;
  }

  protected function value($name)
  {
    return $this->model->{$name};
  }

  protected function error($name)
  {
    return ucfirst($this->model->get_error($name));
  }

  protected function invalid($name)
  {
    return $this->model->has_error($name)
      ? 'is-invalid'
      : null;
  }

  protected function valid($name)
  {
    return $this->model->has_error($name);
  }
}
