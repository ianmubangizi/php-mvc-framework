<?php

namespace Mubangizi\Core\Widget\Form;

use Mubangizi\Core\Widget\Html;

interface Attributable extends Typeable, Nameable, Effectible, Iconable, Stylable
{
    public function placeholder(string $text): Attributable;
}
