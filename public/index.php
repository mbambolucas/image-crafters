<?php

declare(strict_types=1);

# including sugar functions
include __DIR__ . "/../src/App/functions.php";

# including autoloading files composer
$app = include __DIR__ . "/../src/App/bootstrap.php";

# calling run function from App Class
$app->run();
