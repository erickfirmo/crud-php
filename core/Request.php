<?php

namespace Core;

class Request
{
    use Validator;
    
    // retorna valor do campo
    public static function input($inputName)
    {
        return isset($this->inputs[$inputName]) ? $this->inputs[$inputName] : null;
    }
}