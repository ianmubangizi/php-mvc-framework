<?php

namespace Mubangizi\Core;

use Mubangizi\Core\Exception\HttpException;

class Router
{

  public Request $request;
  public Response $response;
  protected array $routes = [];

  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
  }

  private function regex_route($path)
  {
    $route = preg_replace('/\//', '\\/', $path);
    $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
    return  '/^' . $route . '$/i';
  }

  private function add($method, $path, $action): Route
  {
    $url = $this->regex_route($path);
    $this->routes[$method][$path] = new Route($url, $path, $action, $method);
    return $this->routes[$method][$path];
  }

  public function get($path, $action)
  {
    return $this->add('get', $path, $action);
  }

  public function post($path, $action)
  {
    return $this->add('post', $path, $action);
  }

  public function with(array $middlewares, array $member)
  {
    foreach ($member as $routes) {
      foreach ($routes as $route) {
        $route->middlewares($middlewares);
      }
    }
  }

  public function match($path, $action, $methods = ['get', 'post']): RouteSetter
  {
    $actions = [];
    foreach ($methods as $method) {
      $actions[] = $this->add($method, $path, $action);
    }
    return new RouteSetter($actions);
  }

  public function resolve()
  {
    $params = [];
    $path = $this->request->path();
    $method = $this->request->method();

    $match_route = function (Route $route) use ($path, &$params) {
      return preg_match($route->url, $path, $params);
    };

    $match = array_filter($this->routes[$method], $match_route);

    if ($match) {
      $route = array_values($match)[0];
      [$controller, $function] = $route->action;

      Application::$app->set_controller(new $controller());

      foreach ($route->middlewares as $middleware) {
        $middleware = new $middleware();

        $middleware->route = $route;
        $middleware->params = $params;

        $middleware->app = Application::$app;
        $middleware->controller = Application::$app->get_controller();

        $middleware->request = $this->request;
        $middleware->response = $this->response;
      }

      return call_user_func(
        [
          Application::$app->get_controller(), $function
        ],
        $this->request,
        $this->response,
        $params
      );
    } else {
      throw new HttpException('Page not Found', 404);
    }
  }
}
