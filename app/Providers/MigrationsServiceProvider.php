<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $mainPath = database_path('migrations');

        $tablesDirectories = glob($mainPath . '/**/Tables', GLOB_ONLYDIR);
        $relationsDirectories = glob($mainPath . '/**/Relations', GLOB_ONLYDIR);
        $updatesDirectories = glob($mainPath . '/**/Updates', GLOB_ONLYDIR);

        $paths = array_merge(
            [$mainPath], 
            $tablesDirectories,
            $relationsDirectories,
            $updatesDirectories
        );

        $this->loadMigrationsFrom($paths);
    }
}
