<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CategoryResourcesServiceProvider extends ServiceProvider
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
        $slug = 'categories';

        $this->app->bind('CategoryRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('CategoryLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Category\CategoryController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('CategoryRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Category\CategoryController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('CategoryLayouts');
            });

        View::composer( $this->app->make('CategoryLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('CategoryRoutes')]);
        });

    }

}
