<?php

namespace App\Providers\Admin;

use App\Models\Category\Category;
use App\Models\Status\CommonStatus;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PageResourcesServiceProvider extends ServiceProvider
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
        $slug = 'pages';

        $this->app->bind('PageRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('PageLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Page\PageController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('PageRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Page\PageController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('PageLayouts');
            });

        View::composer( $this->app->make('PageLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('PageRoutes'),
                'statuses' => CommonStatus::get(),
            ]);
        });

    }

}
