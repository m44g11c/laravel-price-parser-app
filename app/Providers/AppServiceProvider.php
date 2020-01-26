<?php

namespace App\Providers;

// use App\Http\Controllers\ImportController;
use App\Http\Middleware\CheckUserRole;
use App\Role\RoleChecker;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CheckUserRole::class, function(Application $app) {
            return new CheckUserRole(
                $app->make(RoleChecker::class)
            );
        });

        // $this->app->singleton(ImportController::class, function(Application $app) {
        //     return new ImportController(
        //         $app->make(ImportController::class)
        //     );
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
