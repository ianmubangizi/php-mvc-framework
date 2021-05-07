<?php

namespace Mubangizi\Core\Widget\Form;

interface Button extends Typeable
{

    public function onclick($callback): Attributable;
}
