<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class NotificationResourcesServiceProvider extends ServiceProvider
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
        $slug = 'notifications';

        $this->app->bind('NotificationRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'read'    => "admin.$slug.read",
            ];
        });

        $this->app->bind('NotificationLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Notification\NotificationController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('NotificationRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Notification\NotificationController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('NotificationLayouts');
            });

        View::composer( $this->app->make('NotificationLayouts'), function($view) {
            return $view->with(['routes' => (object) $this->app->make('NotificationRoutes')]);
        });

    }

}
