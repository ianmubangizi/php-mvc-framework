<?php

namespace Mubangizi\Core\Widget;

use Closure;

abstract class Widget implements Html
{
    protected string | Closure $html = '';
    protected ?string $icon = null;
    protected string $name = '';
    protected string $type = '';
    protected string $label = '';
    protected string $styles = '';
    protected string $placeholder = '';
    protected array $classes = [];
    protected array $callbacks = [];

    public function render(): string
    {
        return is_string($this->html) ? $this->html : call_user_func($this->html);
    }

    public function __toString()
    {
        return $this->render();
    }
}
