<?php

namespace App;

class Route
{
    public $route_data = [];

    public function __construct($uri, $class, $method, $request_method)
    {
        $this->route_data['uri'] = $uri;
        $this->route_data['class'] = $class;
        $this->route_data['method'] = $method;
        $this->route_data['request_method'] = $request_method;
    }

    public function getUri()
    {
        return $this->route_data['uri'];
    }

    public function getClass()
    {
        return $this->route_data['class'];
    }

    public function getMethod()
    {
        return $this->route_data['method'];
    }

    public function getRequestMethod()
    {
        return $this->route_data['request_method'];
    }
}
