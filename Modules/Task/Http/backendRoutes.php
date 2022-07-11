<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/task'], function (Router $router) {
    $router->bind('task', function ($id) {
        return app('Modules\Task\Repositories\TaskRepository')->find($id);
    });
    $router->get('tasks', [
        'as' => 'admin.task.task.index',
        'uses' => 'TaskController@index',
        'middleware' => 'can:task.tasks.index'
    ]);
    $router->get('tasks/create', [
        'as' => 'admin.task.task.create',
        'uses' => 'TaskController@create',
        'middleware' => 'can:task.tasks.create'
    ]);
    $router->post('tasks', [
        'as' => 'admin.task.task.store',
        'uses' => 'TaskController@store',
        'middleware' => 'can:task.tasks.create'
    ]);
    $router->get('tasks/{task}/edit', [
        'as' => 'admin.task.task.edit',
        'uses' => 'TaskController@edit',
        'middleware' => 'can:task.tasks.edit'
    ]);
    $router->put('tasks/{task}', [
        'as' => 'admin.task.task.update',
        'uses' => 'TaskController@update',
        'middleware' => 'can:task.tasks.edit'
    ]);
    $router->delete('tasks/{task}', [
        'as' => 'admin.task.task.destroy',
        'uses' => 'TaskController@destroy',
        'middleware' => 'can:task.tasks.destroy'
    ]);
// append

});
