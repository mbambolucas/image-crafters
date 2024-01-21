<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    public function __construct(private string $basePath)
    {
    }

    # to render templates to controllers
    public function render(string $template, array $data = [])
    {
        # extract values into individual variable base on their key names
        # Import variables from an array into the current symbol table
        extract($data, EXTR_SKIP);

        # start the bufferring / creating a buffer / store content in an output buffer
        ob_start();

        # include the tamplate 
        include $this->resolve($template);

        # Return the contents of the output buffer
        $output = ob_get_contents();

        # Clean (erase) the output buffer and turn off output buffering
        ob_end_clean();

        return $output;
    }

    public function resolve(string $path)
    {
        return "{$this->basePath}/{$path}";
    }
}
