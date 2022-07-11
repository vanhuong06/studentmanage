<?php

namespace Modules\Major\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Major\Events\Handlers\RegisterMajorSidebar;

class MajorServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterMajorSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('majors', array_dot(trans('major::majors')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('major', 'permissions');

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
            'Modules\Major\Repositories\MajorRepository',
            function () {
                $repository = new \Modules\Major\Repositories\Eloquent\EloquentMajorRepository(new \Modules\Major\Entities\Major());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Major\Repositories\Cache\CacheMajorDecorator($repository);
            }
        );
// add bindings

    }
}
