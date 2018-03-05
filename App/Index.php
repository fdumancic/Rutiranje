<?php

namespace App;

require_once 'Route.php';
require_once 'Router.php';

Router::GET('/', 'HomeController@index');
Router::GET('/about', 'PostController@read');
Router::POST('/post', 'HomeController@create');
Router::PUT('/put', 'HomeController@show');
Router::PATCH('/patch', 'HomeController@read');
Router::DELETE('/delete', 'PostController@delete');

try {
	Router::resolve();
} catch (\Exception $e) {
	var_dump($e);
}