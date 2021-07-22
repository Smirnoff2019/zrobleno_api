<?php

namespace App\Providers\Admin;

use App\Models\Status\TenderStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class TenderResourcesServiceProvider extends ServiceProvider
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
        $slug = 'tenders';

        $this->app->bind('TenderRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('TenderLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Tender\TenderController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('TenderRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Tender\TenderController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('TenderLayouts');
            });

        View::composer( $this->app->make('TenderLayouts'), function($view) {
            return $view->with([
                'routes' => (object) $this->app->make('TenderRoutes'),
                'statuses' =>  TenderStatus::all()
            ]);
        });

    }

}
