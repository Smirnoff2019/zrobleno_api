<?php

namespace App\Providers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComplaintResourcesServiceProvider extends ServiceProvider
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
        $slug = 'complaints';

        $this->app->bind('ComplaintRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('ComplaintLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Complaint\ComplaintController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('ComplaintRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Complaint\ComplaintController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('ComplaintLayouts');
            });

        View::composer( $this->app->make('ComplaintLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('ComplaintRoutes')]);
        });

    }

}
