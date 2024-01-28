<?php

declare(strict_types=1);

# autoload all namespaces and files with composer
require __DIR__ . "/../../vendor/autoload.php";

# imports App Class
use Framework\App;
use App\Config\Paths;

# import a function
use function App\Config\{registerRoutes, registerMiddleware};

// Initiate app class from Framework
$app = new App(Paths::SOURCE . "App/container-definitions.php");

# calling imported function from Routes function file
registerRoutes($app);
registerMiddleware($app);

# returns the app output to public / index.php
return $app;
