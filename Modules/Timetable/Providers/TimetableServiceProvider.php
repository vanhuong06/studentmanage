<?php

namespace Modules\Timetable\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Timetable\Events\Handlers\RegisterTimetableSidebar;

class TimetableServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterTimetableSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('timetables', array_dot(trans('timetable::timetables')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('timetable', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Timetable\Repositories\TimeTableRepository',
            function () {
                $repository = new \Modules\Timetable\Repositories\Eloquent\EloquentTimeTableRepository(new \Modules\Timetable\Entities\TimeTable());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Timetable\Repositories\Cache\CacheTimeTableDecorator($repository);
            }
        );
// add bindings

    }
}
