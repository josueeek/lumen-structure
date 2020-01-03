<?php

$router->group(
    ['prefix' => 'auth'],
    function () use ($router) {
        $router->post(
            'login',
            ['uses' => 'AuthController@login']
        );
        $router->post(
            'me',
            ['uses' => 'AuthController@me']
        );
        $router->post(
            'refresh',
            ['uses' => 'AuthController@refresh']
        );
        $router->post(
            'logout',
            ['uses' => 'AuthController@logout']
        );
    }
);

// Clients
$router->group(
    ['prefix' => 'clients'],
    function () use ($router) {
        $router->get(
            '/',
            ['uses' => 'ClientsController@index']
        );
        $router->get(
            '/{id}',
            ['uses' => 'ClientsController@view']
        );
        $router->post(
            '/',
            ['uses' => 'ClientsController@add']
        );
        $router->put(
            '/{id}',
            ['uses' => 'ClientsController@edit']
        );
        $router->delete(
            '/{id}',
            ['uses' => 'ClientsController@delete']
        );
    }
);
