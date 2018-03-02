<?php

namespace App;
include 'Route.php';

class Router
{
    public static $routes = [];

/*    public function add($uri, $callback, $request_method)
    {
        $this->_uri[] = '/' . trim($uri, '/');
        $this->_callback[] = $callback;
        $this->_requestMethod[] = $request_method;
    }

    public static function resolve($routes)
    {
        foreach ($variable as $key => $value) {

            //return call_user_func(array($class, $method));
        }
    }

    public static function match($route)
    {
        $matched = false;
        $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        $useMethod = $route['request_method'];
        $value = $route['uri'];
        if(preg_match("#^$value$#", $uriGetParam) && ($_SERVER['REQUEST_METHOD'] == $useMethod)){
            $matched = true;
            return $matched;                
        }
    }

    public static function dispatch()
    {
        foreach (self::$routes as $route) {
            if(match($route) {
                $useCallback = $route['callback'];
                $class ='App\Controllers\\'.self::getClass($useCallback);
                $method = self::getMethod($useCallback);
                return call_user_func(array($class, $method);
            }
        }
    }
*/
    public static function GET($url, $callback)
    {
        $route = new Route($url, $callback, 'GET');
        array_push(self::$routes, $route);
    }
}

Router::GET('/', 'HomeController@index');
Router::GET('/users', 'PostController@read');

var_dump($routes); //fix
die();