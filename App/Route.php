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
    protected $params = [];

    protected $routes = []; */

    private $_uri = [];
    private $_callback = [];
    private $_requestMethod = [];


 /*   public function __construct(array $arguments = [])
    {
        $this->routes = $arguments;
    }
*/
    public function add($uri, $callback, $request_method)
    {
        $this->_uri[] = '/' . trim($uri, '/');
        if($callback != null) {
            $this->_callback[] = $callback;
        }
        if($request_method != null) {
            $this->_requestMethod[] = $request_method;
        }

    }

    public function resolve()
    {
        echo $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        echo '<br />';
        foreach ($this->_uri as $key => $value) {

            if(preg_match("#^$value$#", $uriGetParam)){
                $useCallback = $this->_callback[$key];
                $class = 'App\\'.self::getClass($useCallback);
                $method = self::getMethod($useCallback);

                $useMethod = $this->_requestMethod[$key];
            if($_SERVER['REQUEST_METHOD'] == $useMethod){
                var_dump($useMethod);
                 
            }
                return call_user_func(array($class, $method));
            }

        }
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

/*    public static function resolve($uri, $callback)
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
*/
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

    public function delete()
    {
        var_dump('This is method delete');
    }

}

class PostController
{
    public function read()
    {
        var_dump('This is method read');
    }

}
/*Route::get('/home', 'HomeController@home');*/

$a = new Route(["uri" => "/home", "callback" => "Controller@index"]);
/*$a->resolve();*/

