<?php

namespace App;

require_once 'Route.php';
require_once 'Controllers\HomeController.php';
require_once 'Controllers\PostController.php';


class Router
{
    const CONTROLLER_NAMESPACE = "\App\Controllers\\";
    protected static $routes = [];
    protected $has_match = false;
    protected $has_path = false;
    protected $has_method = false;
    protected static $instance;

    public static function getInstance()
    {
        if(empty(self::$instance)) {

           self::$instance = new Router;
        }
 
        return self::$instance;
    }

    public static function resolve()
    {
        foreach (self::$routes as $route) {
            $matched_route = self::validate($route->route_data);
            if($matched_route != null){
                break;
            }
        }

        if(self::$instance->has_match) {
            self::dispatch($matched_route);
        }

        if(!self::$instance->has_path) {
            throw new \Exception('Wrong path');
        }

        if(!self::$instance->has_method) {
            throw new \Exception('Wrong request method');
        }
    }

    public static function validate($route)
    {
        $instance = self::getInstance();

        $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        $value = $route['uri'];
        $requestMethod = $route['request_method'];

        if(preg_match("#^$value$#", $uriGetParam)) {
            self::$instance->has_path = true;
        }

        if($requestMethod == $_SERVER['REQUEST_METHOD'] && preg_match("#^$value$#", $uriGetParam)) {
            self::$instance->has_method = true;
        }

        if($requestMethod == $_SERVER['REQUEST_METHOD'] && preg_match("#^$value$#", $uriGetParam)) {
            self::$instance->has_match = true;
            return $route;
        }
    }

    public static function dispatch($route)
    {
        $class = self::CONTROLLER_NAMESPACE . $route['class'];
        $method = $route['method'];
        $instance = new $class;
        $instance->$method();
    }

    public static function __callStatic($method, $arguments)
    {
        if(in_array($method, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])){
            if(count($arguments)) {
                $exploded = explode('@', $arguments[1]); 
                $route = new Route($arguments[0], $exploded[0], $exploded[1], $method);
                self::$routes[] = $route;
            }
        } else {
            $class = get_called_class();
            $trace = debug_backtrace();
            $file = $trace[0]['file'];
            $line = $trace[0]['line'];
            trigger_error("Call to undefined method $class::$method() in $file on line $line", E_USER_ERROR);
        }
    }
}
