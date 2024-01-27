<?php

declare(strict_types=1);

# It stores definition for the container
# it stores instruction to create a class

# factory design pattern
# It stores function that create an instance of a class

use Framework\TemplateEngine;
use App\Config\Paths;

# returing an instance of the class
return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW)
];
