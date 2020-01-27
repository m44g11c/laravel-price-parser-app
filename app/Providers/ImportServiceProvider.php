<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Import\ImportService;
use App\Import\CsvImport;
use App\Import\TxtImport;


class ImportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\ImportService', function ($app) {
            $importServiceObj = new ImportService();
            $importServiceObj->addType(new CsvImport(), 'csv');
            $importServiceObj->addType(new TxtImport(), 'txt');

            return $importServiceObj;
        });
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
