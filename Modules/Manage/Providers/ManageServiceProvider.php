<?php

namespace Modules\Manage\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Manage\Events\Handlers\RegisterManageSidebar;

class ManageServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterManageSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('manages', array_dot(trans('manage::manages')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('manage', 'permissions');

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
            'Modules\Manage\Repositories\ManageRepository',
            function () {
                $repository = new \Modules\Manage\Repositories\Eloquent\EloquentManageRepository(new \Modules\Manage\Entities\Manage());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Manage\Repositories\Cache\CacheManageDecorator($repository);
            }
        );
// add bindings

    }
}
