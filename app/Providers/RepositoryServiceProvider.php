<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\{
    TenantRepositoryInterface, CategoryRepositoryInterface, ProjetoRepositoryInterface, ClientRepositoryInterface
};
use App\Repositories\{
    TenantRepository, CategoryRepository, ProjetoRepository, ClientRepository
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class,
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );
    
        $this->app->bind(
            ProjetoRepositoryInterface::class,
            ProjetoRepository::class,
        );

        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
