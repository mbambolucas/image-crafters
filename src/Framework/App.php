<?php

declare(strict_types=1);

namespace Framework;

class App
{
    # declaring router class
    private Router $router;

    #declaring container class
    private Container $container;

    # contractor of the class
    public function __construct(string $containerDefinitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        # check if container definition path have a value before it is passed to Container->addDefinitions Method
        if ($containerDefinitionsPath) {
            # grabing the array of the container
            $containerDefinitions = include $containerDefinitionsPath;

            # adding new container definition
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    # running method 
    public function run()
    {
        # extract the path from server variable
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        # extract the http method from server variable
        $method = $_SERVER['REQUEST_METHOD'];

        # call dispatch method from the Router class
        $this->router->despatch($path, $method, $this->container);
    }

    # add a path with a GET method
    # add method is from the Router class
    public function get(string $path, array $controller)
    {
        $this->router->add($path, 'GET', $controller);
    }
}
