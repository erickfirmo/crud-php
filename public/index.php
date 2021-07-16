<?php

require __DIR__ . '/../helpers/view.php';

// Requires composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Creating the router instance
$router = new \ErickFirmo\Router;

// Defining routes
require __DIR__.'/../routes/app.php';

// Run the router
$router->run();
