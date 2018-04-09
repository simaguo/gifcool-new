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

$router->get('/','ExampleController@index');

$api = app('api.router');//app('Dingo\Api\Routing\Router');

$api->version(['v1','v2'], ['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function ($api) use ($router) {

    $api->post('/login', \App\Http\Controllers\AuthController::class . '@login');
    //$api->options('/login', \App\Http\Controllers\AuthController::class . '@login');
    $api->post('/regist', \App\Http\Controllers\AuthController::class . '@regist');

    $api->get('/gifs',\App\Http\Controllers\GifsController::class.'@index');
});

//echo '<pre>';print_r((array)$api->getRoutes());exit;