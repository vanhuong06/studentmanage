<?php

namespace Modules\Addmajor\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Addmajor\Events\Handlers\RegisterAddmajorSidebar;

class AddmajorServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterAddmajorSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('addmajors', array_dot(trans('addmajor::addmajors')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('addmajor', 'permissions');

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
            'Modules\Addmajor\Repositories\AddMajorRepository',
            function () {
                $repository = new \Modules\Addmajor\Repositories\Eloquent\EloquentAddMajorRepository(new \Modules\Addmajor\Entities\AddMajor());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Addmajor\Repositories\Cache\CacheAddMajorDecorator($repository);
            }
        );
// add bindings

    }
}
