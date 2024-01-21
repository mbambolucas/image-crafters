<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class ProfileDetailsController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function profileDetails()
    {
        echo $this->view->render("/portfolio-details.php", [
            "title" => "Profile details"
        ]);
    }
}
