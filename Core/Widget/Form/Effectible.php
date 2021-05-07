<?php

namespace Mubangizi\Core\Widget\Form;

use Mubangizi\Core\Widget\Html;

interface Effectible
{
    public function onchange($value): Attributable;
}
