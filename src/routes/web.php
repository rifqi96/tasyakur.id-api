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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return [
            'message' => 'OK!'
        ];
    });

    /**
     * Group for backend API prefix
     * 
     */
    $router->group([
        'prefix' => 'backend',
        'namespace' => 'Backend'
    ], function () use ($router) {
        /**
         * Group for auth middleware
         * 
         */
        $router->group(['middleware' => 'oauth_client'], function () use ($router) {
            $router->get('/', function () {
                dd(Auth::user());
            });

            /**
             * Group for /users endpoint
             */
            $router->group(['prefix' => 'users'], function () use ($router) {
              $router->get('/', 'UserController@getAll');
            });
        });

        //
    });

    /**
     * Group for frontend API prefix
     * 
     */
    $router->group([
        'prefix' => 'frontend',
        'namespace' => 'Frontend'
    ], function () use ($router) {
        //
    });
});

/**
 * Below are routes for dev purpose
 * 
 */
if (config('app.debug')) {
    $router->get('/', function () use ($router) {
        return [
            'app_ver' => $router->app->version(),
        ];
    });
    
    $router->get('env', function () {
        return [
            'config' => [
                'app' => config('app'),
                'mail' => config('mail'),
            ],
            'full_env' => getenv(),
        ];
    });
} else {
    $router->get('/', function () {
        return [
            'message' => 'Ok!',
        ];
    });
}
