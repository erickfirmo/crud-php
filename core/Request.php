<?php

namespace Core;

class Request
{
    public $status = true;

    public $lang;

    public $errors;
    
    public function __construct()
    {
        $this->lang = include __DIR__.'/../views/lang/'.app('lang').'.php';

        Session::put('old_fields', $_POST);
    }
    
    public function input($inputName)
    {
        if(isset($_POST[$inputName]))
            return $_POST[$inputName];
    }

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

    public function required($inputName, $param=0)
    {
        if(!isset($_POST[$inputName]) || empty($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['required'] = 'O campo '.$this->lang[$inputName].' é obrigatório.';
        }
    }

    public function max($inputName, $max)
    {
        if($max < strlen($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['max'] = 'O campo '.$this->lang[$inputName].' não deve ter mais que '.$max.' caracteres.';
        }
    }

    public function min($inputName, $min)
    {
        if($min > strlen($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['min'] = 'O campo '.$this->lang[$inputName].' deve ter mais que '.$min.' caracteres.';
        }  else {
            return false;
        }
    }
    
    public function datatype($inputName, $type)
    {
        if($type != gettype($_POST[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['datatype'] = 'O campo '.$this->lang[$inputName].' deve ser do tipo '.$type.'.';
        }  else {
            return false;
        }
    }

    public function getInputName($inputName) {
        return isset($this->lang[$inputName]) ? $this->lang[$inputName] : $inputName;
    }
}