<?php

namespace App;

include 'Route.php';

/*Route::get('/', 'HomeController@index');

Route::get('/rutiranje/App/', 'HomeController@index');

Route::post('/create', 'PostController@create');*/

$route = new Route();

$route->add('/', 'HomeController@index', 'GET');
$route->add('/about', 'HomeController@delete', 'GET');
$route->add('/contact', 'PostController@read', 'POST');

echo '<pre>';
print_r($route);

$route->resolve();

echo '<pre>';
