<?php

// Requires composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Iniciando session
\Core\Session::start();

// Creating the router instance
$router = new \ErickFirmo\Router;

// Defining erro page 404
$router->notFoundView(__DIR__.'/../views/errors/404.php');

// Requires helpers
require __DIR__ . '/../helpers/functions.php';

// Load external routes file 
require __DIR__.'/../routes/app.php';

// Run the router
$router->run();  
