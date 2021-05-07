<?php

namespace Mubangizi\Core\Widget\Form;

use Mubangizi\Core\Widget\Html;

interface Typeable extends Html
{
    public function type(string $is): Attributable;
}
