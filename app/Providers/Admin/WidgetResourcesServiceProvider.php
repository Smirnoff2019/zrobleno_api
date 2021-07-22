<?php

namespace App\Providers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WidgetResourcesServiceProvider extends ServiceProvider
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
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $slug = 'widgets';

        $this->app->bind('WidgetRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('WidgetLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Widget\WidgetController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('WidgetRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Widget\WidgetController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('WidgetLayouts');
            });

        View::composer( $this->app->make('WidgetLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('WidgetRoutes')]);
        });

    }

}
