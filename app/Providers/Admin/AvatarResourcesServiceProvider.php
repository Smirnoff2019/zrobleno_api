<?php

namespace App\Providers\Admin;

use App\Models\Status\CommonStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AvatarResourcesServiceProvider extends ServiceProvider
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
        $slug = 'avatars';

        $this->app->bind('AvatarRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('AvatarLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Avatar\AvatarController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('AvatarRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Avatar\AvatarController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('AvatarLayouts');
            });

        View::composer( $this->app->make('AvatarLayouts'), function($view) {
            return $view->with([
                'routes'  => (object) $this->app->make('AvatarRoutes'),
                'genders' => [
                    'man'   => 'Чоловік',
                    'woman' => 'Жінка'
                ],
                'colors' => [
                    'blue'   => 'Синій',
                    'yellow' => 'Жовтий',
                    'green'  => 'Зелений',
                    'red'    => 'Красний',
                    'purple' => 'Фіолетовий',
                ],
                'statuses' => CommonStatus::get(),
            ]);
        });

    }

}
