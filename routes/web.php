<?php

$router->get('/', HomeController::class, 'index');
$router->get('/pessoas', CustomerController::class, 'index');
$router->get('/pessoas/cadastrar', CustomerController::class, 'create', 'customers.create');
$router->get('/pessoas/editar/{$id}', CustomerController::class, 'edit');
$router->get('/pessoas/{id}', CustomerController::class, 'show', 'customers.show');
$router->get('/pessoas/cadastrar', CustomerController::class, 'create', 'customers.create');
$router->post('/pessoas/store', CustomerController::class, 'store');
$router->put('/pessoas/update/{$id}', CustomerController::class, 'update');
$router->delete('/pessoas/destroy/{$id}', CustomerController::class, 'destroy');
