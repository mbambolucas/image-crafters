<?php

declare(strict_types=1);

namespace Framework;

use App\Controller\HomeController;

class Router
{
    # empty array for routes
    private array $routes = [];

    # method received path, method, and controller array (controller class name and method) from  Framework/App
    public function add(string $path, string $method, array $controller)
    {
        # calling function to format the path
        $path = $this->normalizePath($path);

        # adding the route with path and http method
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    # To format the path to /about/
    private function normalizePath(string $path): string
    {
        # remove forward slashes from the path
        $path = trim($path, '/');

        # add two forward slashes
        $path = "/{$path}/";

        # regular expression to replace consecutive forward slashes
        $path = preg_replace('#[/]{2,}#', '/', $path);

        return $path;
    }

    # to send data to the view / to dispatch content to be displayed
    public function despatch(string $path, string $method)
    {
        # format the path
        $path = $this->normalizePath($path);

        # convert the http method to upper cases
        $method = strtoupper($method);

        # loop through the route
        # check the path method if we find the match we will display the content
        foreach ($this->routes as $route) {

            # verify if the route march the current url
            # check if the method match
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                continue;
            }

            //echo $path . $method;

            # we are grading the class and the method from the route
            # reference to bootstrap.php get method parameters
            [$class, $function] = $route['controller'];

            # class instance of the class
            $controllerInstance = new $class;

            # envoke the method passed into the route
            $controllerInstance->{$function}();
        }
    }
}
