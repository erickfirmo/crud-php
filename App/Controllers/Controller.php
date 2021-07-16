<?php

namespace App\Controllers;

class Controller {
    public function redirect($route)
    {
        header("Location: ".(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http')."://".$_SERVER['HTTP_HOST'].$route);
        exit();
    }
}