<?php

namespace App\Providers;

use App\Import\ImportStrategyManager;
use Illuminate\Support\ServiceProvider;
use App\Import\Strategy\CsvImportStrategy;
use App\Import\Strategy\TxtImportStrategy;
use App\Import\ImportStrategyServiceInterface;

class ImportServiceProvider extends ServiceProvider
{
    public $bindings = [
        ImportStrategyServiceInterface::class => ImportStrategyManager::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ImportStrategyManager::class)
            ->needs('$importStrategies')
            ->give(function () {

                return [
                    CsvImportStrategy::TYPE => CsvImportStrategy::class,
                    TxtImportStrategy::TYPE => TxtImportStrategy::class,
                ];
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
