<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/manage'], function (Router $router) {
    $router->bind('manage', function ($id) {
        return app('Modules\Manage\Repositories\ManageRepository')->find($id);
    });
    $router->get('manages', [
        'as' => 'admin.manage.manage.index',
        'uses' => 'ManageController@index',
        'middleware' => 'can:manage.manages.index'
    ]);
    $router->get('manages/create', [
        'as' => 'admin.manage.manage.create',
        'uses' => 'ManageController@create',
        'middleware' => 'can:manage.manages.create'
    ]);
    $router->post('manages', [
        'as' => 'admin.manage.manage.store',
        'uses' => 'ManageController@store',
        'middleware' => 'can:manage.manages.create'
    ]);
    $router->get('manages/{manage}/edit', [
        'as' => 'admin.manage.manage.edit',
        'uses' => 'ManageController@edit',
        'middleware' => 'can:manage.manages.edit'
    ]);
    $router->put('manages/{manage}', [
        'as' => 'admin.manage.manage.update',
        'uses' => 'ManageController@update',
        'middleware' => 'can:manage.manages.edit'
    ]);
    $router->delete('manages/{manage}', [
        'as' => 'admin.manage.manage.destroy',
        'uses' => 'ManageController@destroy',
        'middleware' => 'can:manage.manages.destroy'
    ]);
// append

});
