<?php

namespace App\Providers\Admin;

use App\Models\Status\TenderApplicationStatus;
use App\Models\Status\TenderRestartStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TenderRestartResourcesServiceProvider extends ServiceProvider
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
        $slug = 'tenders.restart-applications';

        $this->app->bind('TenderRestartApplicationRoutes', function ($app) use ($slug) {
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

        $this->app->bind('TenderRestartApplicationLayouts', function ($app) use ($slug) {
            return [
                'index'  => "admin.$slug.index",
                'create' => "admin.$slug.create",
                'edit'   => "admin.$slug.edit",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Tender\TenderRestartController::class])
            ->needs('$routes')
            ->give(function ($app) {
                return $this->app->make('TenderRestartApplicationRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Tender\TenderRestartController::class])
            ->needs('$layouts')
            ->give(function ($app) {
                return $this->app->make('TenderRestartApplicationLayouts');
            });

        View::composer($this->app->make('TenderRestartApplicationLayouts'), function ($view) {
            return $view->with([
                'routes'   => (object) $this->app->make('TenderRestartApplicationRoutes'),
                'statuses' => TenderRestartStatus::all(),
            ]);
        });

    }

}
