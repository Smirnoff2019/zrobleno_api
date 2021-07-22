<?php

namespace App\Providers\Admin;

use App\Models\Status\CommonStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AccessTokenResourcesServiceProvider extends ServiceProvider
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
        $slug = 'accessTokens';

        $this->app->bind('AccessTokenRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('AccessTokenLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\AccessToken\AccessTokenController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('AccessTokenRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\AccessToken\AccessTokenController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('AccessTokenLayouts');
            });

        View::composer( $this->app->make('AccessTokenLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('AccessTokenRoutes'),
                'statuses' => CommonStatus::get() 
            ]);
        });

    }

}
