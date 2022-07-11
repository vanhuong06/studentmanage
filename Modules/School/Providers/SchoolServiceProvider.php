<?php

namespace Modules\School\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\School\Events\Handlers\RegisterSchoolSidebar;

class SchoolServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterSchoolSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('schools', array_dot(trans('school::schools')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('school', 'permissions');

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
            'Modules\School\Repositories\SchoolRepository',
            function () {
                $repository = new \Modules\School\Repositories\Eloquent\EloquentSchoolRepository(new \Modules\School\Entities\School());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\School\Repositories\Cache\CacheSchoolDecorator($repository);
            }
        );
// add bindings

    }
}
