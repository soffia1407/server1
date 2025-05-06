<?php
namespace Src;

use Error;

class Route
{
    private static array $routes = [];
    private static string $prefix = '';

    public static function setPrefix($value)
    {
        self::$prefix = rtrim($value, '/');
    }

    public static function add(string $route, array $action): void
    {
        $route = '/' . ltrim($route, '/');
        self::$routes[$route] = $action;
    }

    public function start(): void
    {
        try {
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $path = str_replace(self::$prefix, '', $path);
            $path = $path === '' ? '/' : $path;
            
            if (!isset(self::$routes[$path])) {
                header("HTTP/1.0 404 Not Found");
                echo "404 - Route {$path} not found";
                exit;
            }

            [$class, $method] = self::$routes[$path];

            if (!class_exists($class)) {
                throw new Error("Class {$class} not found");
            }

            $controller = new $class();
            
            if (!method_exists($controller, $method)) {
                throw new Error("Method {$method} not found in {$class}");
            }

            echo $controller->$method();
            
        } catch (Error $e) {
            header("HTTP/1.0 500 Internal Server Error");
            echo "500 - " . $e->getMessage();
            exit;
        }
    }
}
