<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, ProfileDetailsController};

function registerRoutes(App $app)
{
    # Calling get method from App class
    # register the controller
    # array contains name of the class and method of the controller
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/portfolio-details', [ProfileDetailsController::class, 'profileDetails']);
}
