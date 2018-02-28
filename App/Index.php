<?php

namespace App;

include_once 'Route.php';

Route::get('/rutiranje/App/', 'HomeController@index');

Route::post('/create', 'PostController@create');