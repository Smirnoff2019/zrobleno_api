<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PortfolioCategoryResourcesServiceProvider extends ServiceProvider
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
        $slug = 'portfolios.categories';

        $this->app->bind('PortfolioCategoryRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('PortfolioCategoryLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Portfolio\PortfolioCategoryController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('PortfolioCategoryRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Portfolio\PortfolioCategoryController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('PortfolioCategoryLayouts');
            });

        View::composer( $this->app->make('PortfolioCategoryLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('PortfolioCategoryRoutes')]);
        });

    }

}
