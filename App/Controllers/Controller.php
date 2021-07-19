<?php

namespace App\Controllers;

use Core\Request;
use Core\Session;

class Controller {
    public $request;

    public function __construct()
    {
        $this->request = new Request;
    }

    public function redirect(string $route) : Object
    {
        header("Location: ".(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http')."://".$_SERVER['HTTP_HOST'].$route);
        exit;
    }

    public function back()
    {
        header('location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }

    public function request() : Object
    {
        return $this->request;
    }
    
    public function jsonResponse(array $array)
    {
        echo json_encode($array);
    }

    public function error($name, $message) {
        $errors = Session::get('alert-errors');
        
        if(isset($errors[$name])) {
            array_push($errors[$name], $message);
        } else {
            $errors[$name][0] = $message;
        }
        
        Session::put('alert-errors', $errors);
    }

    public function success($message) {
        Session::put('alert-success', $message);
    }
}