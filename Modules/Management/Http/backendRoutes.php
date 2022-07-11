<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/management'], function (Router $router) {
    $router->bind('management', function ($id) {
        return app('Modules\Management\Repositories\ManagementRepository')->find($id);
    });
    $router->get('management', [
        'as' => 'admin.management.management.index',
        'uses' => 'ManagementController@index',
        'middleware' => 'can:management.management.index'
    ]);
    $router->get('management/create', [
        'as' => 'admin.management.management.create',
        'uses' => 'ManagementController@create',
        'middleware' => 'can:management.management.create'
    ]);
    $router->post('management', [
        'as' => 'admin.management.management.store',
        'uses' => 'ManagementController@store',
        'middleware' => 'can:management.management.create'
    ]);
    $router->get('management/{management}/edit', [
        'as' => 'admin.management.management.edit',
        'uses' => 'ManagementController@edit',
        'middleware' => 'can:management.management.edit'
    ]);
    $router->put('management/{management}', [
        'as' => 'admin.management.management.update',
        'uses' => 'ManagementController@update',
        'middleware' => 'can:management.management.edit'
    ]);
    $router->delete('management/{management}', [
        'as' => 'admin.management.management.destroy',
        'uses' => 'ManagementController@destroy',
        'middleware' => 'can:management.management.destroy'
    ]);
    $router->bind('category', function ($id) {
        return app('Modules\Management\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.management.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:management.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.management.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:management.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.management.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:management.categories.create'
    ]);
    $router->get('categories/{category}/edit', [
        'as' => 'admin.management.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:management.categories.edit'
    ]);
    $router->put('categories/{category}', [
        'as' => 'admin.management.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:management.categories.edit'
    ]);
    $router->delete('categories/{category}', [
        'as' => 'admin.management.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:management.categories.destroy'
    ]);
// append


});
