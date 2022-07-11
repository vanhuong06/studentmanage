<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/timetable'], function (Router $router) {
    $router->bind('timetable', function ($id) {
        return app('Modules\Timetable\Repositories\TimeTableRepository')->find($id);
    });
    $router->get('timetables', [
        'as' => 'admin.timetable.timetable.index',
        'uses' => 'TimeTableController@index',
        'middleware' => 'can:timetable.timetables.index'
    ]);
    $router->get('timetables/create', [
        'as' => 'admin.timetable.timetable.create',
        'uses' => 'TimeTableController@create',
        'middleware' => 'can:timetable.timetables.create'
    ]);
    $router->post('timetables', [
        'as' => 'admin.timetable.timetable.store',
        'uses' => 'TimeTableController@store',
        'middleware' => 'can:timetable.timetables.create'
    ]);
    $router->get('timetables/{timetable}/edit', [
        'as' => 'admin.timetable.timetable.edit',
        'uses' => 'TimeTableController@edit',
        'middleware' => 'can:timetable.timetables.edit'
    ]);
    $router->put('timetables/{timetable}', [
        'as' => 'admin.timetable.timetable.update',
        'uses' => 'TimeTableController@update',
        'middleware' => 'can:timetable.timetables.edit'
    ]);
    $router->delete('timetables/{timetable}', [
        'as' => 'admin.timetable.timetable.destroy',
        'uses' => 'TimeTableController@destroy',
        'middleware' => 'can:timetable.timetables.destroy'
    ]);
// append

});
