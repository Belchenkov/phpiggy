<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function add(string $method, string $path, array $controller): void
    {
        $path = $this->normalizePath($path);

        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller,
        ];
    }

    public function dispatch(string $path, string $method, Container $container = null): void
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                continue;
            }

            [$class, $function] = $route['controller'];
            $controller_instance = $container ? $container->resolve($class) : new $class;
            $controller_instance->$function();
        }
    }

    public function addMiddleware(string $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";

        return preg_replace('#[/]{2,}#', '/', $path);
    }
}
