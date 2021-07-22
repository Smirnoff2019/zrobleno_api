<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CoefficientPerRegionResourcesServiceProvider extends ServiceProvider
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
        $slug = 'calculator-settings.coefficient-per-region';

        $this->app->bind('CoefficientPerRegionRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('CoefficientPerRegionLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\CoefficientPerRegionController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('CoefficientPerRegionRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\CoefficientPerRegionController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('CoefficientPerRegionLayouts');
            });

        View::composer( $this->app->make('CoefficientPerRegionLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('CoefficientPerRegionRoutes')]);
        });
    }

}
