<?php

$router->get('/api/pessoas', \Api\CustomerController::class, 'index', 'api.customers.index');
$router->get('/api/pessoas/{id}', \Api\CustomerController::class, 'show', 'api.customers.show');
$router->post('/api/pessoas/store', \Api\CustomerController::class, 'store', 'api.customers.show');
$router->put('/api/pessoas/update/{id}', \Api\CustomerController::class, 'update', 'api.customers.show');
$router->delete('/api/pessoas/destroy/{id}', \Api\CustomerController::class, 'destroy', 'api.customers.destroy');
