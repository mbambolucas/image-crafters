<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController
{
    # declare TemplateEngine as view
    public function __construct(private TemplateEngine $view)
    {
        # instatiate the template engine class and passing VIEW constant from Paths Class
        //$this->view = new TemplateEngine(Paths::VIEW);

    }

    # method to be called by the router
    public function home()
    {
        # to pass the view template to  render method in TemplateEngine to include the view
        echo $this->view->render("/index.php");
    }
}
