<?php

namespace App;

class Route
{
/*    protected $requestMethods = ['get', 'post'];

    public $callback;
    public $uri;
    public $class;
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];*/

    protected $routes = [];

    public function __construct(array $arguments = [])
    {
        $this->routes = $arguments;
    }

    public static function getClass($callback)
    {
    	if (is_string($callback) === true && strpos($callback, '@') !== false) {
            $tmp = explode('@', $callback);
            return $tmp[0];
        }
        return null;
    }

    public static function getMethod($callback)
    {
    	if (is_string($callback) === true && strpos($callback, '@') !== false) {
            $tmp = explode('@', $callback);
            return $tmp[1];
        }
        return null;
    }

    public function getRequestMethod()
    {
    	return $this->requestMethods;
    }

    public static function resolve($uri, $callback)
    {
    	if($_SERVER['REQUEST_URI'] == $uri) {
            $class = 'App\\'.self::getClass($callback);
            $method = self::getMethod($callback);

           return call_user_func(array($class, $method));
        }
        else {
            var_dump('wrong uri');
            die();
        }
    }

    public static function get($uri, $callback)
    {
        $class_name = get_called_class();
        $class = new $class_name;
        var_dump('GET');
        return call_user_func_array(array($class, 'resolve'), array($uri, $callback));
    }

    public static function post($uri, $callback)
    {
    	$class_name = get_called_class();
        $class = new $class_name;
        var_dump('POST');
        return call_user_func_array(array($class, 'resolve'), array($uri, $callback));
    }

    public function __get($name)
    {
        if(array_key_exists($name, $this->routes)) {
            return $this->routes[$name];
        }
    }
}

class HomeController
{
    public function index()
    {
        var_dump('This is method index');
    }

}

class PostController
{
    public function create()
    {
        var_dump('This is function create');
    }

}
/*Route::get('/home', 'HomeController@home');*/

$a = new Route(["uri" => "/home", "callback" => "Controller@index"]);
/*$a->resolve();*/

