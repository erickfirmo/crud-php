<?php

#
ini_set('display_errors', 1);

#
ini_set('display_startup_errors', 1);

# 
error_reporting(E_ALL);

# Requires composer autoloader
require __DIR__ . '/../vendor/autoload.php';

# Iniciando session
\Core\Session::start();

# Requires helpers
require __DIR__ . '/../helpers/functions.php';

# Creating the router instance
$router = new \ErickFirmo\Router;

# Defining generic error page 
$ambience = 'local';

# Instanciando kernel
$kernel = new \Core\Kernel();

# Configurando página de errors (prod)
$kernel->errorsPage(__DIR__.'/../views/errors/500.php');

# Configurando página de errors (dev/local)
if('prod' != $ambience) {
    $kernel->errorsPage(__DIR__.'/../views/errors/exceptions.php');
}

# Defining error page 404
$router->notFoundView(__DIR__.'/../views/errors/404.php');

# Load external routes file 
require __DIR__.'/../routes/web.php';

# Run the router and creating the request 
$kernel->handle($router);
