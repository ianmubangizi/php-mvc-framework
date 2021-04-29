<?php

namespace Mubangizi\Core;

class Response
{

    public function __construct()
    {
    }

    public function set_status(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $path)
    {
        return header("Location: $path");
    }
}
