<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MetaFieldsGroupResourcesServiceProvider extends ServiceProvider
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
        $slug = 'meta-fields.groups';

        $this->app->bind('MetaFieldsGroupRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('MetaFieldsGroupLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\MetaFieldsGroup\MetaFieldsGroupController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('MetaFieldsGroupRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\MetaFieldsGroup\MetaFieldsGroupController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('MetaFieldsGroupLayouts');
            });

        View::composer( $this->app->make('MetaFieldsGroupLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('MetaFieldsGroupRoutes')]);
        });
    }

}
