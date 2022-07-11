<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/major'], function (Router $router) {
    $router->bind('major', function ($id) {
        return app('Modules\Major\Repositories\MajorRepository')->find($id);
    });
    $router->get('majors', [
        'as' => 'admin.major.major.index',
        'uses' => 'MajorController@index',
        'middleware' => 'can:major.majors.index'
    ]);
    $router->get('majors/create', [
        'as' => 'admin.major.major.create',
        'uses' => 'MajorController@create',
        'middleware' => 'can:major.majors.create'
    ]);
    $router->post('majors', [
        'as' => 'admin.major.major.store',
        'uses' => 'MajorController@store',
        'middleware' => 'can:major.majors.create'
    ]);
    $router->get('majors/{major}/edit', [
        'as' => 'admin.major.major.edit',
        'uses' => 'MajorController@edit',
        'middleware' => 'can:major.majors.edit'
    ]);
    $router->put('majors/{major}', [
        'as' => 'admin.major.major.update',
        'uses' => 'MajorController@update',
        'middleware' => 'can:major.majors.edit'
    ]);
    $router->delete('majors/{major}', [
        'as' => 'admin.major.major.destroy',
        'uses' => 'MajorController@destroy',
        'middleware' => 'can:major.majors.destroy'
    ]);
// append

});
