<?php

namespace App\Controllers;

use Core\Request;
use Core\Session;

class Controller {
    public $request;

    // redireciona para a rota passada
    public function redirect(string $route) : void
    {
        header("Location: ".(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http')."://".$_SERVER['HTTP_HOST'].$route);
        exit;
    }

    // redireciona para a rota anteior
    public function back() : void
    {
        header('location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }

    // seta mensagem de erro
    public function error($name, $message)
    {
        $errors = Session::get('alert-errors');
        
        if(isset($errors[$name])) {
            array_push($errors[$name], $message);
        } else {
            $errors[$name][0] = $message;
        }
        
        Session::put('alert-errors', $errors);
    }

    // seta mensagem de sucesso
    public function success($message)
    {
        Session::put('alert-success', $message);
    }
}