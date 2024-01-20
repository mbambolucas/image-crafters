<?php

declare(strict_types=1);

# autoload all namespaces and files with composer
require __DIR__ . "/../../vendor/autoload.php";

# imports App Class
use Framework\App;
use App\Controllers\HomeController;

// Initiate app class from Framework
$app = new App();

# Calling get method from App class
# register the controller
# array contains name of the class and method of the controller
$app->get('/', [HomeController::class, 'home']);

# returns the app output to public / index.php
return $app;
