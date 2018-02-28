<?php

namespace App;

include 'Route.php';

/*Route::get('/', 'HomeController@index');

Route::get('/rutiranje/App/', 'HomeController@index');

Route::post('/create', 'PostController@create');*/

$route = new Route();

$route->add('/', 'HomeController@index');
$route->add('/about', 'HomeController@index');
$route->add('/contact', 'PostController@read');

echo '<pre>';
print_r($route);

$route->resolve();

echo '<pre>';
print_r($_SERVER);
