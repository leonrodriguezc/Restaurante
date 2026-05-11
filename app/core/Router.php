<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function put(string $path, array $handler): void
    {
        $this->routes['PUT'][$path] = $handler;
    }

    public function delete(string $path, array $handler): void
    {
        $this->routes['DELETE'][$path] = $handler;
    }

    public function dispatch(string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        $this->loadRoutes();

        if (isset($this->routes[$method][$uri])) {
            [$controller, $action] = $this->routes[$method][$uri];
            $controllerClass = "App\\Controllers\\{$controller}Controller";
            if (class_exists($controllerClass)) {
                $instance = new $controllerClass();
                $instance->$action();
                return;
            }
        }

        http_response_code(404);
        echo "404 - Página no encontrada";
    }

    private function loadRoutes(): void
    {
        $routesFile = APP_PATH . '/config/routes.php';
        if (file_exists($routesFile)) {
            $routes = require $routesFile;
            foreach ($routes as $method => $methodRoutes) {
                foreach ($methodRoutes as $path => $handler) {
                    $this->routes[$method][$path] = $handler;
                }
            }
        }
    }
}