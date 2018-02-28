<?php
class Route
{
    public $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
}

class Router
{
    public $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
    public function getClass()
    {
    	if (is_string($this->callback) === true && strpos($this->callback, '@') !== false) {
            $tmp = explode('@', $this->callback);
            return $tmp[0];
        }
        return null;
    }

    public function getMethod()
    {
    	if (is_string($this->callback) === true && strpos($this->callback, '@') !== false) {
            $tmp = explode('@', $this->callback);
            return $tmp[1];
        }
        return null;
    }

    public function resolve($url, $callback)
    {
        $matched = false;
        foreach($this->routes as $route) {
            if(in_array($url, $route->routes)) {
                $matched = true;
                break;
            }
        }

        if(!$matched) throw new Exception('Could not match route.');

        $match = clone($route);

        $match->getClass();
        $match->getMethod();

        var_dump($match->class);
        die();

        return $match;
    }
}

class Controller
{
    public function read()
    {
        /*var_dump(func_get_args());
        var_dump('read');
        die();*/
    }
}

$route = new Route(['request_method' => 'get', 'pattern' => '/read', 'callback' => 'Controller@read']);
/*$route->callback    = 'Controller@read';
$route->pattern = '/read';
$route->class   = 'Controller';
$route->method  = 'read';*/

$router = new Router(array($route));
$match  = $router->resolve('/read', 'Controller@read');

// Dispatch
if($match) {
    call_user_func_array(array(new $match->class, $match->method), $match->params);
}