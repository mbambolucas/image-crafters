<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class ProfileDetailsController
{
    public function __construct(private TemplateEngine $view)
    {
    }

    public function profileDetails()
    {
        echo $this->view->render("/portfolio-details.php", [
            "title" => "Profile details"
        ]);
    }
}
