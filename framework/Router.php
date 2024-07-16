<?php

namespace Framework;

use ReflectionMethod;

class Router
{
    private $routes = [];

    public function get($uri, $callback)
    {
        $this->addRoute('GET', $uri, $callback);
    }

    public function post($uri, $callback)
    {
        $this->addRoute('POST', $uri, $callback);
    }

    public function put($uri, $callback)
    {
        $this->addRoute('PUT', $uri, $callback);
    }

    public function delete($uri, $callback)
    {
        $this->addRoute('DELETE', $uri, $callback);
    }

    private function addRoute($method, $uri, $callback)
    {
        $this->routes[] = compact('method', 'uri', 'callback');
    }

    public function handle()
    {
        $uri = $this->getUri();
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($this->convertToRegex($route['uri']), $uri, $matches)) {
                array_shift($matches);
                if (is_callable($route['callback'])) {
                    call_user_func($route['callback'], $matches);
                    return;
                }

                if (is_array($route['callback'])) {
                    $this->callController($route['callback'], $matches);
                    return;
                }
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    private function callController($callback, $matches)
    {
        list($controller, $method) = $callback;

        if (!class_exists($controller)) {
            http_response_code(404);
            echo "Controller $controller class not found.";
            return;
        }

        $controllerObject = new $controller();

        if (!method_exists($controllerObject, $method)) {
            http_response_code(404);
            echo "Method $method not found.";
            return;
        }

        $reflector = new ReflectionMethod($controller, $method);
        $parameters = $reflector->getParameters();
        $args = [];

        foreach ($parameters as $parameter) {
            $paramName = $parameter->getType() ? $parameter->getType()->getName() : null;

            if ($paramName === Request::class) {
                $args[] = new Request();
            } elseif ($paramName && class_exists($paramName)) {
                // TODO : get the current data in Model $paramName
                // $args[] = $paramName::find(array_shift($matches));
                $args[] = null;
            } elseif (!empty($matches)) {
                $args[] = array_shift($matches);
            } else {
                print_r("OKK");
                // TODO : handle other types of parameters
                $args[] = null;
            }
        }

        call_user_func([$controllerObject, $method], ...$args);
    }

    private function getUri()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        return '/' . $uri;
    }

    private function convertToRegex($uri)
    {
        return "/^" . preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_-]+)', str_replace('/', '\/', $uri)) . "$/";
    }
}
