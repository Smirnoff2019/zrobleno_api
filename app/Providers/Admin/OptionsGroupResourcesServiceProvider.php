<?php

namespace App\Providers\Admin;

use App\Models\Room\Room;
use App\Models\Status\CommonStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class OptionsGroupResourcesServiceProvider extends ServiceProvider
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
        $slug = 'options-groups';

        $this->app->bind('OptionGroupsRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('OptionGroupsLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\OptionsGroup\OptionsGroupController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('OptionGroupsRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\OptionsGroup\OptionsGroupController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('OptionGroupsLayouts');
            });

        View::composer( $this->app->make('OptionGroupsLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('OptionGroupsRoutes'),
                'rooms' => Room::get(),
                'statuses' => CommonStatus::get(),
            ]);
        });
    }

}
