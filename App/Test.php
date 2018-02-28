<?php
class Route
{
public $routes = [
    'blog/view' => 'Example@index',
    'api/forum/create' => 'other.php'
];

public $url = explode('/', $_GET['url']);

if (isset($url[0]))
{
    if ($url[0] == 'api')
    {
        $params = array_slice($url, 3);
        $url = array_slice($url, 0, 3);
    }
    else
    {
        $params = array_slice($url, 2);
        $url = array_slice($url, 0, 2);
    }
}

$url = implode('/', $url);

if (array_key_exists($url, $routes))
{
    $path = explode('/', $routes[$url]);
    unset($path[count($path)]);
    $segments = end($path);
    $segments = explode('@', $segments);

    $controller = $segments[0];
    $method = $segments[1];

    require_once APP_ROOT . '/app/' . $controller . '.php';
    $controller = new $controller;

    call_user_func_array([$controller, $method], $params);
}
}