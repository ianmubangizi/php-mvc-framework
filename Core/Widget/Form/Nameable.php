<?php

namespace Mubangizi\Core\Widget\Form;

use Mubangizi\Core\Form\Field;
use Mubangizi\Core\Widget\Html;

interface Nameable extends Html
{
    public function name(string $is): Attributable;
}
