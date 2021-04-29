<?php

namespace Mubangizi\Core\Widget;


abstract class Widget
{

    protected abstract function html(): string;

    public function __toString()
    {
        return $this->html();
    }
}
