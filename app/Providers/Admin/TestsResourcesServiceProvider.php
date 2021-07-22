<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class TestsResourcesServiceProvider extends ServiceProvider
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
        $slug = 'tests';

        $this->app->bind('TestsRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('TestsLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Tests\TestsController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('TestsRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Tests\TestsController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('TestsLayouts');
            });

        View::composer( $this->app->make('TestsLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('TestsRoutes')]);
        });

    }

}
