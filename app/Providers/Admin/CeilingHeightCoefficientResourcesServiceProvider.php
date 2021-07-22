<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CeilingHeightCoefficientResourcesServiceProvider extends ServiceProvider
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
        $slug = 'calculator-settings.ceiling-height-coefficient';

        $this->app->bind('CeilingHeightCoefficientRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('CeilingHeightCoefficientLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\CeilingHeightCoefficientController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('CeilingHeightCoefficientRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\CeilingHeightCoefficientController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('CeilingHeightCoefficientLayouts');
            });

        View::composer( $this->app->make('CeilingHeightCoefficientLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('CeilingHeightCoefficientRoutes')]);
        });
    }

}
