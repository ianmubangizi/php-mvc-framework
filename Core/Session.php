<?php

namespace Mubangizi\Core;

class Session
{

    public function __construct()
    {
        session_start();
    }

    public function get($key)
    {
        return key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
}
