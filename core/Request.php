<?php

namespace Core;

class Request
{
    public $status = true;

    public $lang;

    public $errors;

    public $inputs;
    
    public function __construct()
    {
        // seta idioma da request
        $this->lang = include __DIR__.'/../views/lang/'.app('lang').'.php';
    }
    
    // retorna valor do campo
    public function input($inputName)
    {
        if(isset($_POST[$inputName])) 
            return $_POST[$inputName];
    }

    // valida campos da requisição
    public function validate(array $rules)
    {
        foreach ($rules as $inputName => $rule)
        {
            $rulesArray = explode('|', $rule);
            foreach ($rulesArray as $r)
            {
                $requestArray = explode(':', $r);
                $requestAction = $requestArray[0]; 
                $requestParam = isset($requestArray[1]) ? $requestArray[1] : NULL;
                $this->$requestAction($inputName, $requestParam);
            }   
        }

        Session::put('alert-errors', $this->errors);

        return $this->status;
    }

    // retorna nome do campo no idioma setado
    public function getInputName($inputName) {
        return isset($this->lang[$inputName]) ? $this->lang[$inputName] : $inputName;
    }

    // retorna mensagem de erro do campo no idioma setado
    public function getMessage($inputRule)
    {
        return $this->lang['messages'][$inputRule];
    }

    // regra para obrigatoriedade do campo
    public function required($inputName, $param=0)
    {
        $this->inputs[$inputName] = $_POST[$inputName];

        if(!isset($_POST[$inputName]) || empty($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['required'] = $this->getMessage($inputName.'.required');
        }
    }

    // regra para máximo de caracteres do valor do campo
    public function max($inputName, $max)
    {
        $this->inputs[$inputName] = $_POST[$inputName];

        if($max < strlen($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['max'] = $this->getMessage($inputName.'.max');
        }
    }

    // regra para mínimo de caracteres do valor do campo
    public function min($inputName, $min)
    {
        $this->inputs[$inputName] = $_POST[$inputName];

        if($min > strlen($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['min'] = $this->getMessage($inputName.'.min');
        }  else {
            return false;
        }
    }
    
    // regra para tipo de dado do valor do campo
    public function datatype($inputName, $type)
    {
        $this->inputs[$inputName] = $_POST[$inputName];

        if($type != gettype($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['datatype'] = $this->getMessage($inputName.'.datatype');
        }  else {
            return false;
        }
    }
}