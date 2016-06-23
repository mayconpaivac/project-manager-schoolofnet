<?php

namespace ManagerProject\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\ManagerProject\Repositories\ClientRepository::class, \ManagerProject\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\ManagerProject\Repositories\ProjectRepository::class, \ManagerProject\Repositories\ProjectRepositoryEloquent::class);
        $this->app->bind(\ManagerProject\Repositories\ProjectNoteRepository::class, \ManagerProject\Repositories\ProjectNoteRepositoryEloquent::class);
        $this->app->bind(\ManagerProject\Repositories\ProjectTaskRepository::class, \ManagerProject\Repositories\ProjectTaskRepositoryEloquent::class);
        $this->app->bind(\ManagerProject\Repositories\ProjectFileRepository::class, \ManagerProject\Repositories\ProjectFileRepositoryEloquent::class);
        $this->app->bind(\ManagerProject\Repositories\UserRepository::class, \ManagerProject\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
