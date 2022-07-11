<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/school'], function (Router $router) {
    $router->bind('school', function ($id) {
        return app('Modules\School\Repositories\SchoolRepository')->find($id);
    });
    $router->get('schools', [
        'as' => 'admin.school.school.index',
        'uses' => 'SchoolController@index',
        'middleware' => 'can:school.schools.index'
    ]);
    $router->get('schools/create', [
        'as' => 'admin.school.school.create',
        'uses' => 'SchoolController@create',
        'middleware' => 'can:school.schools.create'
    ]);
    $router->post('schools', [
        'as' => 'admin.school.school.store',
        'uses' => 'SchoolController@store',
        'middleware' => 'can:school.schools.create'
    ]);
    $router->get('schools/{school}/edit', [
        'as' => 'admin.school.school.edit',
        'uses' => 'SchoolController@edit',
        'middleware' => 'can:school.schools.edit'
    ]);
    $router->put('schools/{school}', [
        'as' => 'admin.school.school.update',
        'uses' => 'SchoolController@update',
        'middleware' => 'can:school.schools.edit'
    ]);
    $router->delete('schools/{school}', [
        'as' => 'admin.school.school.destroy',
        'uses' => 'SchoolController@destroy',
        'middleware' => 'can:school.schools.destroy'
    ]);
// append

});
