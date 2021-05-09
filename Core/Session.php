<?php

namespace Mubangizi\Core;

class Session
{

    public function __construct()
    {
        session_start();
    }

    public static function get($key)
    {
        return key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }
}
