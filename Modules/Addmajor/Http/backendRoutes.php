<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/addmajor'], function (Router $router) {
    $router->bind('addmajor', function ($id) {
        return app('Modules\Addmajor\Repositories\AddMajorRepository')->find($id);
    });
    $router->get('addmajors', [
        'as' => 'admin.addmajor.addmajor.index',
        'uses' => 'AddMajorController@index',
        'middleware' => 'can:addmajor.addmajors.index'
    ]);
    $router->get('addmajors/create', [
        'as' => 'admin.addmajor.addmajor.create',
        'uses' => 'AddMajorController@create',
        'middleware' => 'can:addmajor.addmajors.create'
    ]);
    $router->post('addmajors', [
        'as' => 'admin.addmajor.addmajor.store',
        'uses' => 'AddMajorController@store',
        'middleware' => 'can:addmajor.addmajors.create'
    ]);
    $router->get('addmajors/{addmajor}/edit', [
        'as' => 'admin.addmajor.addmajor.edit',
        'uses' => 'AddMajorController@edit',
        'middleware' => 'can:addmajor.addmajors.edit'
    ]);
    $router->put('addmajors/{addmajor}', [
        'as' => 'admin.addmajor.addmajor.update',
        'uses' => 'AddMajorController@update',
        'middleware' => 'can:addmajor.addmajors.edit'
    ]);
    $router->delete('addmajors/{addmajor}', [
        'as' => 'admin.addmajor.addmajor.destroy',
        'uses' => 'AddMajorController@destroy',
        'middleware' => 'can:addmajor.addmajors.destroy'
    ]);
// append

});
