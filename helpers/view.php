<?php

function view(string $view, array $values=null)
{
    // cria variaveis dinamicamente
    if($values != null)
        foreach($values as $responseName => $responseValue)
            $$responseName = $responseValue;

    // retorna view 
    $view = str_replace('.', '/', $view);
    include '../views/'.$view.'.php';
}
