<?php

namespace App\Providers\Admin;

use App\Models\Status\TenderApplicationStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TenderApplicationResourcesServiceProvider extends ServiceProvider
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
        $slug = 'tenders.applications';

        $this->app->bind('TenderApplicationRoutes', function ($app) use ($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
                'reject'  => "admin.$slug.reject",
                'confirm' => "admin.$slug.confirm",
            ];
        });

        $this->app->bind('TenderApplicationLayouts', function ($app) use ($slug) {
            return [
                'index'  => "admin.$slug.index",
                'create' => "admin.$slug.create",
                'edit'   => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\TenderApplication\TenderApplicationController::class])
            ->needs('$routes')
            ->give(function ($app) {
                return $this->app->make('TenderApplicationRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\TenderApplication\TenderApplicationController::class])
            ->needs('$layouts')
            ->give(function ($app) {
                return $this->app->make('TenderApplicationLayouts');
            });

        View::composer($this->app->make('TenderApplicationLayouts'), function ($view) {
            return $view->with([
                'routes'   => (object) $this->app->make('TenderApplicationRoutes'),
                'statuses' => TenderApplicationStatus::all(),
            ]);
        });

    }

}
