<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PropertyConditionCoefficientResourcesServiceProvider extends ServiceProvider
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
        $slug = 'calculator-settings.property-condition-coefficient';

        $this->app->bind('PropertyConditionCoefficientRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('PropertyConditionCoefficientLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\PropertyConditionCoefficientController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('PropertyConditionCoefficientRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\CalculatorSettings\PropertyConditionCoefficientController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('PropertyConditionCoefficientLayouts');
            });

        View::composer( $this->app->make('PropertyConditionCoefficientLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('PropertyConditionCoefficientRoutes')]);
        });
    }

}
