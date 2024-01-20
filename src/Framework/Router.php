<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    # empty array for routes
    private array $routes = [];

    public function add(string $path, string $method)
    {
        # calling function to format the path
        $path = $this->normalizePath($path);

        # adding the route with path and http method
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method)
        ];
    }

    # To format the path to /about/
    private function normalizePath(string $path): string
    {
        # remove forward slashes from the path
        $path = trim($path, '/');

        # add two forward slashes
        $path = "/{$path}/";

        return $path;
    }
}
