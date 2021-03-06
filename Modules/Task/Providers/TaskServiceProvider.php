<?php

namespace Modules\Task\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Task\Events\Handlers\RegisterTaskSidebar;

class TaskServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterTaskSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('tasks', array_dot(trans('task::tasks')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('task', 'permissions');

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
            'Modules\Task\Repositories\TaskRepository',
            function () {
                $repository = new \Modules\Task\Repositories\Eloquent\EloquentTaskRepository(new \Modules\Task\Entities\Task());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Task\Repositories\Cache\CacheTaskDecorator($repository);
            }
        );
// add bindings

    }
}
