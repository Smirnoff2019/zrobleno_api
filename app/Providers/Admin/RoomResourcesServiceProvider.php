<?php

namespace App\Providers\Admin;

use App\Models\Status\CommonStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class RoomResourcesServiceProvider extends ServiceProvider
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
        $slug = 'rooms';

        $this->app->bind('RoomRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('RoomLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Room\RoomController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('RoomRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Room\RoomController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('RoomLayouts');
            });

        View::composer( $this->app->make('RoomLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('RoomRoutes'),
                'statuses' => CommonStatus::all(),
            ]);
        });

    }

}
