<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use App\Models\{
    Plan, Tenant, Categoria, Projeto, Tipouser
};
use App\Observers\{
    PlanObserver, TenantObserver, CategoriaObserver, ProjetoObserver, TipouserObserver
};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        Schema::defaultStringLength(191);
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Categoria::observe(CategoriaObserver::class);
        Tipouser::observe(TipouserObserver::class);
        Projeto::observe(ProjetoObserver::class);
    }
}
