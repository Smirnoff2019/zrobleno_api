<?php

namespace App\Providers\Admin;

use App\Models\Status\CommonStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PostResourcesServiceProvider extends ServiceProvider
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
        $slug = 'posts';

        $this->app->bind('PostRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('PostLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Post\PostController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('PostRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Post\PostController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('PostLayouts');
            });

        View::composer( $this->app->make('PostLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('PostRoutes'),
                'statuses' => CommonStatus::get(),
            ]);
        });

    }

}
