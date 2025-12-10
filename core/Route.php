<?php

class Route
{
    public static $routes = [];

    public static function get($uri, $controller = null, $action = null, $name = null)
    {
        return self::addRoute('GET', $uri, $controller, $action, $name);
    }

    public static function post($uri, $controller = null, $action = null, $name = null)
    {
        return self::addRoute('POST', $uri, $controller, $action, $name);
    }

    public static function put($uri, $controller = null, $action = null, $name = null)
    {
        return self::addRoute('PUT', $uri, $controller, $action, $name);
    }

    public static function delete($uri, $controller = null, $action = null, $name = null)
    {
        return self::addRoute('DELETE', $uri, $controller, $action, $name);
    }

    public static function patch($uri, $controller = null, $action = null, $name = null)
    {
        return self::addRoute('PATCH', $uri, $controller, $action, $name);
    }

    private static function addRoute($method, $uri, $controller, $action, $name)
    {
        $route = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'name' => $name,
            'middleware' => []
        ];

        self::$routes[] = $route;

        return new RouteInstance($route);
    }

    public static function dispatch($requestUri, $requestMethod)
    {
        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && self::matchUri($route['uri'], $requestUri, $params)) {
                return self::callAction($route, $params);
            }
        }

        // Fallback to old system or 404
        return self::fallback($requestUri, $requestMethod);
    }

    private static function matchUri($routeUri, $requestUri, &$params)
    {
        $params = [];

        // Simple parameter matching: {id}
        $routePattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $routeUri);
        $routePattern = '#^' . $routePattern . '$#';

        if (preg_match($routePattern, $requestUri, $matches)) {
            array_shift($matches); // Remove full match
            $params = $matches;
            return true;
        }

        return false;
    }

    private static function callAction($route, $params = [])
    {
        $controller = $route['controller'];
        $action = $route['action'];

        if (is_callable($controller)) {
            return call_user_func_array($controller, $params);
        }

        // Assume no namespace for simplicity
        $controllerClass = $controller;
        
        if (class_exists($controllerClass)) {
            $instance = new $controllerClass();
            if (method_exists($instance, $action)) {
                return call_user_func_array([$instance, $action], $params);
            }
        } else {
            echo 'Class not found: '. $controllerClass;
        }

        throw new Exception("Controller or action not found: $controllerClass@$action");
    }

    private static function fallback($requestUri, $requestMethod)
    {
        // For backward compatibility, check if action is in query string
        if ($requestMethod === 'GET' && isset($_GET['action'])) {
            $action = $_GET['action'];
            // Map old actions to new routes if possible, or handle directly
            // For now, include old routes.php logic
            require_once 'routes_old.php'; // We'll create this
            return;
        }

        // Custom 404 page
        http_response_code(404);
        require 'views/errors/404.php';
        exit;
    }

    public static function name($name)
    {
        // For named routes, but simplified
        // In full Laravel, this would be used for URL generation
    }
}

function route($name, $params = [])
{
    // Simple route URL generator
    foreach (Route::$routes as $route) {
        if ($route['name'] === $name) {
            $url = $route['uri'];
            foreach ($params as $key => $value) {
                $url = str_replace('{' . $key . '}', $value, $url);
            }
            return $url;
        }
    }
    return '#';
}

class RouteInstance
{
    private $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function name($name)
    {
        $this->route['name'] = $name;
        return $this;
    }

    public function middleware($middleware)
    {
        $this->route['middleware'] = array_merge($this->route['middleware'], (array)$middleware);
        return $this;
    }
}