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

$router->get('/', 'ExampleController@index');

$api = app('api.router');//app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1],
    function (\Dingo\Api\Routing\Router $api) use ($router) {

        $api->post('/auth/login', \App\Http\Controllers\AuthController::class . '@login');
        $api->post('/auth/regist', \App\Http\Controllers\AuthController::class . '@regist');
        $api->post('/auth/refresh', \App\Http\Controllers\AuthController::class . '@refresh');

        $api->get('/gifs', \App\Http\Controllers\GifsController::class . '@index');
        $api->get('/gifs/{id:[0-9]+}', \App\Http\Controllers\GifsController::class . '@show');
        $api->get('/gifs/{id:[0-9]+}/comments', \App\Http\Controllers\GifsController::class . '@comments');

        $api->group(['middleware' => 'api.auth'], function (\Dingo\Api\Routing\Router $api) {
            $api->post('/comments', \App\Http\Controllers\CommentsController::class . '@create');
            $api->post('/gifs/up', \App\Http\Controllers\GifsController::class . '@up');
            $api->post('/gifs/down', \App\Http\Controllers\GifsController::class . '@down');
            $api->post('/gifs/collect', \App\Http\Controllers\GifsController::class . '@collect');
        });
    });
