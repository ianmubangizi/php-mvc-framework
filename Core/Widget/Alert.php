<?php

namespace Mubangizi\Core\Widget;


class Alert extends Widget
{

    public string $type;
    public string $message;
    public bool $displayed = false;

    public const INFO = 'info';
    public const DARK = 'dark';
    public const DANGER = 'danger';
    public const PRIMARY = 'primary';
    public const SUCCESS = 'success';

    public function __construct($message, $type = self::SUCCESS)
    {
        $this->type = $type;
        $this->message = $message;
        $this->html = <<<s
            <div class="position-absolute top-0 start-50 translate-middle-x mt-5">
                <div class="alert alert-$this->type" role="alert" style="min-width: 280px; max-width: 360px;">
                    $this->message
                </div>
            </div>
        s;
    }
}
