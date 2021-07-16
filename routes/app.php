<?php

$router->get(['/', 'CustomerController@welcome']);
$router->get(['/pessoas', 'CustomerController@index']);
$router->get(['/pessoas/cadastrar', 'CustomerController@create']);
$router->get(['/pessoas/editar/{$id}', 'CustomerController@edit']);
$router->get(['/pessoas/{$id}', 'CustomerController@show']);
$router->post(['/pessoas/store', 'CustomerController@store']);
$router->put(['/pessoas/update/{$id}', 'CustomerController@update']);
$router->delete(['/pessoas/destroy/{$id}', 'CustomerController@destroy']);
