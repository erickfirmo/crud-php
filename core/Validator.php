<?php

namespace Core;

trait Validator
{
    public $status = true;

    public $lang;

    public $errors = [];

    public $inputs = [];

    public $validated = [];

    public function validated()
    {
        return $this->inputs;
    }

    // valida campos da requisição
    public function validate(array $rules)
    {
        $this->lang = include __DIR__.'/../views/lang/'.app('lang').'.php';

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
    public function getInputName($inputName)
    {
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
        // verifica se campo não existe
        if(!isset($this->all[$inputName]) || empty($this->all[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['required'] = $this->getMessage($inputName.'.required');
        } else {
            $this->inputs[$inputName] = $this->all[$inputName];
        }
    }

    // regra para máximo de caracteres do valor do campo
    public function max($inputName, $max)
    {
        if($max < strlen($this->all[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['max'] = str_replace(':max', $max, $this->getMessage($inputName.'.max'));
        } else {
            $this->inputs[$inputName] = $this->all[$inputName];
        }
    }

    // regra para mínimo de caracteres do valor do campo
    public function min($inputName, $min)
    {
        if($min > strlen($this->all[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['min'] = $this->getMessage($inputName.'.min');
        }  else {
            $this->inputs[$inputName] = $this->all[$inputName];
        }
    }
    
    // regra para tipo de dado do valor do campo
    public function datatype($inputName, $type)
    {
        if($type != gettype($this->all[$inputName]))
        {
            $this->status = false;
            $this->errors[$inputName]['datatype'] = $this->getMessage($inputName.'.datatype');
        } else {
            $this->inputs[$inputName] = $this->all[$inputName];
        }
    }
}