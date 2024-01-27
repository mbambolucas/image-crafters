<?php

declare(strict_types=1);

namespace App\Config;

class Paths
{
    # defining a constant view as a path to view directory
    public const VIEW = __DIR__ . "/../views";

    #path to point to the src directory of the project
    public const SOURCE = __DIR__ . "/../../";
}
