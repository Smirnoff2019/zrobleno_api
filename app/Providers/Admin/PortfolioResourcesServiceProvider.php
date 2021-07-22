<?php

namespace App\Providers\Admin;

use App\Models\Category\Category;
use App\Models\Category\PortfolioCategory;
use App\Models\Status\CommonStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PortfolioResourcesServiceProvider extends ServiceProvider
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
        $slug = 'portfolios';

        $this->app->bind('PortfolioRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('PortfolioLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Portfolio\PortfolioController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('PortfolioRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Portfolio\PortfolioController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('PortfolioLayouts');
            });

        View::composer( $this->app->make('PortfolioLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('PortfolioRoutes'),
                'statuses' => CommonStatus::get(),
                'categories' => PortfolioCategory::get()
            ]);
        });

    }

}
