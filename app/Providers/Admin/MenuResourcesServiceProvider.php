<?php

namespace App\Providers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuResourcesServiceProvider extends ServiceProvider
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
        $slug = 'menus';

        $this->app->bind('MenuRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('MenuLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Menu\MenuController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('MenuRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Menu\MenuController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('MenuLayouts');
            });

        View::composer( $this->app->make('MenuLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('MenuRoutes')]);
        });

    }

}
