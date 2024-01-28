<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface MiddlewareInterface
{
    # to process the request before the controller handles the request
    # parameters will be the next function
    public function process(callable $next);
}
