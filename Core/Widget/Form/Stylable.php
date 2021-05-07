<?php

namespace Mubangizi\Core\Widget\Form;

use Mubangizi\Core\Widget\Html;

interface Stylable extends Html
{
    public function css(array $classes): Attributable;
}
