<?php

namespace App\Providers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserResourcesServiceProvider extends ServiceProvider
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
        $slug = 'users';

        $this->app->bind('UserRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('UserLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Users\UserController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('UserRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Users\UserController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('UserLayouts');
            });

        View::composer( $this->app->make('UserLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('UserRoutes')]);
        });

    }

}
