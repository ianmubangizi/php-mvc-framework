<?php

namespace Mubangizi\Core\Widget\Form;

use Mubangizi\Core\Widget\Html;

interface Iconable extends Html
{
    public function icon(string $is): Attributable;
}
