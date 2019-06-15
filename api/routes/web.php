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

$router->group(['middleware' => 'cors'], function ($context)  {
    
    $context->post(
        'api/login', 
        [
           'uses' => 'UsersController@authenticate'
        ]
    );

    $context->get('api/me', [
        'uses' => 'UsersController@loggedInUser',
        'middleware' => 'auth'
    ]);

});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Catch all options preflights
$router->options('{all:.*}', ['middleware' => 'cors', function() {
    return response('');
}]);