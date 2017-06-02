<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use mjanssen\BreadcrumbsBundle\Breadcrumbs;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data = [
            'breadcrumbs' => Breadcrumbs::automatic()
        ];

        view()->share($data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'beta')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
