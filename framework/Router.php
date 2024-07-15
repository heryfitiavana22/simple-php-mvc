<?php

namespace Framework;

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->addRoute('POST', $path, $callback);
    }

    private function addRoute($method, $path, $callback)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback,
        ];
    }

    public function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($method === $route['method'] && $path === $route['path']) {
                if (is_callable($route['callback'])) {
                    call_user_func($route['callback']);
                    return;
                }

                if (is_array($route['callback'])) {
                    $this->callController($route['callback']);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "Page not found.";
    }

    private function callController($callback)
    {
        list($controller, $action) = $callback;

        if (!class_exists($controller)) {
            http_response_code(404);
            echo "Controller class not found.";
            return;
        }

        $controllerObject = new $controller();

        if (!method_exists($controllerObject, $action)) {
            http_response_code(404);
            echo "Action not found.";
            return;
        }

        call_user_func([$controllerObject, $action]);
    }
}
