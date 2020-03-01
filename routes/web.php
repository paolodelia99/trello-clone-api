<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Auth routes
$router->post('/login','AuthController@login');
$router->get('/logout','AuthController@logout');
$router->post('/register','AuthController@register');


//Board routes
$router->get('/boards', 'BoardController@index');
$router->post('/boards','BoardController@store');
$router->get('/boards/{id}','BoardController@show');
$router->put('/boards/{boards}','BoardController@update');
$router->delete('boards/{boards}','BoardController@destroy');

//Lists routes
$router->get('/boards/{board}/list','ListController@index');
$router->post('/boards/{board}/list','ListController@store');
$router->get('/boards/{board}/list/{list}','ListController@show');
$router->put('/boards/{board}/list/{list}','ListController@update');
$router->delete('/boards/{board}/list/{list}','ListController@destroy');

//Card routes
$router->get('/boards/{board}/list/{list}/card','CardController@index');
$router->post('/boards/{board}/list/{list}/card','CardController@store');
$router->get('/boards/{board}/list/{list}/card/{card}','CardController@show');
$router->put('/boards/{board}/list/{list}/card/{card}','CardController@update');
$router->delete('/boards/{board}/list/{list}/card/{card}','CardController@destroy');