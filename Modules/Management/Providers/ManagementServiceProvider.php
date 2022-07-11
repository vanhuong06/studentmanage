<?php

namespace Modules\Management\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Management\Events\Handlers\RegisterManagementSidebar;

class ManagementServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterManagementSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('management', array_dot(trans('management::management')));
            $event->load('categories', array_dot(trans('management::categories')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('management', 'permissions');

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
            'Modules\Management\Repositories\ManagementRepository',
            function () {
                $repository = new \Modules\Management\Repositories\Eloquent\EloquentManagementRepository(new \Modules\Management\Entities\Management());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Management\Repositories\Cache\CacheManagementDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Management\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Management\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Management\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Management\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
// add bindings


    }
}
