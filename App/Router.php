<?php

namespace App;

include 'Controllers\Router.php';

class Router
{

    public function add($uri, $callback, $request_method)
    {
        $this->_uri[] = '/' . trim($uri, '/');
        $this->_callback[] = $callback;
        $this->_requestMethod[] = $request_method;
    }

    public function resolve($routes)
    {
        $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        $useMethod = $routes['request_method'];
        $value = $routes['uri'];
        if(preg_match("#^$value$#", $uriGetParam) && ($_SERVER['REQUEST_METHOD'] == $useMethod)){
            $useCallback = $routes['callback'];
            $class = 'App\Controllers\\'.self::getClass($useCallback);
            $method = self::getMethod($useCallback);
            return call_user_func(array($class, $method));                
        }
    }

    public static function GET($url, $callback)
    {
        $route = new Route($url, $callback, 'GET');

        return $route;
    }


    public function __get($name)
    {
        if(array_key_exists($name, $this->routes)) {
            return $this->routes[$name];
        }
    }
}


