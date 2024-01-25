<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exceptions\ContainerException;
use ReflectionClass;

class Container
{
    private array $definitions = [];

    public function addDefinitions(array $new_definitions): void
    {
        $this->definitions = [...$this->definitions, ...$new_definitions];
    }

    /**
     * @throws \ReflectionException
     * @throws ContainerException
     */
    public function resolve(string $classname)
    {
       $reflection_class = new ReflectionClass($classname);

       if (!$reflection_class->isInstantiable()) {
           throw new ContainerException("Class {$classname} is not instantiable!");
       }

       if (!$constructor = $reflection_class->getConstructor()) {
           return new $classname;
       }

       $params = $constructor->getParameters();

       if (count($params) === 0) {
           return new $classname;
       }
    }
}
