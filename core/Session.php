<?php

namespace Core;

class Session {

    static public function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    static public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    static public function push($key, $value)
    {
        $session = $_SESSION[$key];
        array_push($session, $value);
        $_SESSION[$key] = $session;
    }

    static public function get($key)
    {
        
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    static public function remove($key) : void
    {
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }
 }