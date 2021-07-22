<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PropertyWallsConditionCoefficientResourcesServiceProvider extends ServiceProvider
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
        $slug = 'calculator-settings.property-walls-condition-coefficient';

        $this->app->bind('PropertyWallsConditionCoefficientRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('PropertyWallsConditionCoefficientLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\PropertyWallsConditionCoefficientController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('PropertyWallsConditionCoefficientRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\PropertyWallsConditionCoefficientController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('PropertyWallsConditionCoefficientLayouts');
            });

        View::composer( $this->app->make('PropertyWallsConditionCoefficientLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('PropertyWallsConditionCoefficientRoutes')]);
        });
    }

}
