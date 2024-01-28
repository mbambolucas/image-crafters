<?php

declare(strict_types=1);

namespace Framework;

# reflection progragging 
use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

#class responsible of creating other classes
class Container
{
    #creating empty definition array
    private array $definitions = [];

    private array $resolved = [];

    #add new definitions to the array
    public function addDefinitions(array $newDefinitions)
    {
        # Option 1: merging two arrays
        # $this->definitions = array_merge($this->definitions, $newDefinitions);

        # Option 2: maerging two arrays using spread operator
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    {
        # reflective programming
        $reflectionClass = new ReflectionClass($className);

        # verify the class
        if (!$reflectionClass->isInstantiable()) {

            # throw a custom exception
            throw new ContainerException("Class {$className} is not instantiable");
        }

        # get contructor method of the reflection class
        $constructor = $reflectionClass->getConstructor();

        # verify if the class have constructor method
        if (!$constructor) {
            return new $className;
        }

        # retrive constructors parameters for the constructors
        $params = $constructor->getParameters();

        # verify if the constractor have parameters
        if (count($params) === 0) {
            return new $className;
        }

        # dependancies
        $dependancies = [];

        # loop through the params
        foreach ($params as $param) {
            # get parameter name
            $name = $param->getName();

            # get parameter type
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing a type hint.");
            }

            # verify the type hint 
            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name");
            }

            #
            $dependancies[] = $this->get($type->getName());
        }

        # Creates a new class instance from given arguments
        return $reflectionClass->newInstanceArgs($dependancies);
    }

    # return a instance of the dependance
    public function get(string $id)
    {
        #validate the id if there is a parameter with the id
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does not exist in container.");
        }

        # retricting our class to a single instance
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        # factory functions
        $factory = $this->definitions[$id];

        # return value of the function
        $dependancy = $factory();

        # add depandancies to resolved array
        $this->resolved[$id] = $dependancy;

        return $dependancy;
    }
}
