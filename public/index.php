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

# Creating the router instance
$router = new \ErickFirmo\Router;

# Run the router and creating the request 
$kernel->handle($router);
