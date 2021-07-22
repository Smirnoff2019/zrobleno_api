<?php

namespace App\Providers\Admin;

use App\Models\OptionsGroup\OptionsGroup;
use App\Models\Room\Room;
use App\Models\Status\CommonStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class OptionResourcesServiceProvider extends ServiceProvider
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
        $slug = 'options';

        $this->app->bind('OptionRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('OptionLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Option\OptionController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('OptionRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Option\OptionController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('OptionLayouts');
            });

        View::composer( $this->app->make('OptionLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('OptionRoutes'),
                'rooms' => Room::get(),
                'options_groups' => OptionsGroup::get(),
                'statuses' => CommonStatus::get(),
            ]);
        });

    }

}
