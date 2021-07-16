<?php

// Requires composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Creating the router instance
$router = new \ErickFirmo\Router;

  // Requires helpers
require __DIR__ . '/../helpers/view.php';

/* Load external routes file */
require __DIR__.'/../routes/app.php';

// Run the router
$router->run();  
