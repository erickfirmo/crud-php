<?php

namespace Core;

class Request
{
    use Validator;
    #use FormRequest;

    protected $all;

    protected $requestMethod;

    public function __construct()
    {
        $this->setRequestMethod();
        $this->setAll();
    }

    public function setRequestMethod()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    public function setAll()
    {
        $this->all = $this->getRequestMethod() == 'POST' ? $_POST : $_GET;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function all()
    {
        return $this->all;
    }

    // retorna valor do campo
    public function input($inputName)
    {
        return isset($this->all[$inputName]) ? $this->all[$inputName] : null;
    }
}