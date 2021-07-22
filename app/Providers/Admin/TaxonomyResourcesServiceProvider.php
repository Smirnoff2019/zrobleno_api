<?php

namespace App\Providers\Admin;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TaxonomyResourcesServiceProvider extends ServiceProvider
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
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $slug = 'taxonomies';

        $this->app->bind('TaxonomyRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('TaxonomyLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Taxonomy\TaxonomyController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('TaxonomyRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Taxonomy\TaxonomyController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('TaxonomyLayouts');
            });

        View::composer( $this->app->make('TaxonomyLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('TaxonomyRoutes')]);
        });

    }

}
