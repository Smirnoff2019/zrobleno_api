<?php

namespace App\Providers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PostCategoriesResourcesServiceProvider extends ServiceProvider
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
        $slug = 'posts.categories';

        $this->app->bind('PostCategoryRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('PostCategoryLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Post\PostCategoryController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('PostCategoryRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Post\PostCategoryController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('PostCategoryLayouts');
            });

        View::composer( $this->app->make('PostCategoryLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('PostCategoryRoutes')]);
        });

    }

}
