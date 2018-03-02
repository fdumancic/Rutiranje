<?php

namespace App;

include 'Route.php';
include 'Router.php';

/*Route::get('/', 'HomeController@index');

Route::get('/rutiranje/App/', 'HomeController@index');

Route::post('/create', 'PostController@create');

$route = new Router();

$route->add('/', 'HomeController@index', 'GET');
$route->add('/about', 'HomeController@delete', 'GET');
$route->add('/contact', 'PostController@read', 'POST');

$route->GET('/posts', 'PostController@read');

echo '<pre>';
print_r($route);

$route->resolve();

echo '<pre>';
*/

$a = new Route;
$a->GET('/', 'HomeController@index');
$a->GET('/about', 'HomeController@delete');
$a->GET('/users', 'PostController@read');
$a->POST('/posts', 'PostController@read');