<?php

namespace App;

class Route
{
	public static $routes = [];

    public function __construct($url, $callback, $request_method)
    {
        self::$routes['uri'] = $url;
        self::$routes['callback'] = $callback;
        self::$routes['request_method'] = $request_method;
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

    public static function getRequestMethod()
    {
        return self::$routes['request_method'];
    }

    public static function getUri()
    {
        return self::$routes['uri'];
    }


}

$a = new Route('/about', 'HomeController@delete', 'GET');

$uri = $a::getUri();
$method = $a::getMethod($a::$routes['callback']);
$class = $a::getClass($a::$routes['callback']);
$rm = $a::getRequestMethod();

var_dump($uri);
var_dump($class);
var_dump($method);
var_dump($rm);
die();
