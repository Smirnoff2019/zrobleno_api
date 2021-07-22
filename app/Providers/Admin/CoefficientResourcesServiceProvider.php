<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CoefficientResourcesServiceProvider extends ServiceProvider
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
        $slug = 'calculator-settings.coefficient';

        $this->app->bind('CoefficientRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('CoefficientLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug-index",
                'create'  => "admin.$slug-create",
                'edit'    => "admin.$slug-edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\CoefficientController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('CoefficientRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\CoefficientController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('CoefficientLayouts');
            });

        View::composer( $this->app->make('CoefficientLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('CoefficientRoutes')]);
        });
    }

}
