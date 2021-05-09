<?php

namespace Mubangizi\Core;

class Route
{
    public string $url = '';
    public string $name = '';
    public string $path = '';
    public string $method = '';
    public array $action = [];
    public array $middlewares = [];

    public function __construct($url, $path, $action, $method)
    {
        $this->url = $url;
        $this->path = $path;
        $this->action = $action;
        $this->method = $method;
    }

    public function name(string $name): Route
    {
        $this->name = $name;
        return $this;
    }

    public function middlewares(array $middlewares): Route
    {
        $this->middlewares = $middlewares;
        return $this;
    }
}

class RouteSetter
{

    protected array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function name(string $name): array
    {
        foreach ($this->routes as $route) {
            switch ($route->path) {
                case 'get':
                    $route->name($name);
                    break;
                case 'post':
                    $route->name("@$name");
                    break;
                default:
                    # code...
                    break;
            }
        }
        return $this->routes;
    }
}
