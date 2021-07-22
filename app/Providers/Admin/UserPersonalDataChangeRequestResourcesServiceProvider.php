<?php

namespace App\Providers\Admin;

use App\Models\Status\TenderApplicationStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserPersonalDataChangeRequestResourcesServiceProvider extends ServiceProvider
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
        $slug = 'personal-data-requests';

        $this->app->bind('UserPersonalDataChangeRequestRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.users.$slug.index",
//                'store'   => "admin.users.$slug.store",
//                'create'  => "admin.users.$slug.create",
                //'show'    => "admin.users.$slug.show",
                'edit'    => "admin.users.$slug.edit",
                'update'  => "admin.users.$slug.update",
//                'destroy' => "admin.users.$slug.destroy",
                'confirm' => "admin.users.$slug.confirm",
                'reject'  => "admin.users.$slug.reject",
            ];
        });

        $this->app->bind('UserPersonalDataChangeRequestLayouts', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                //'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                //'show'    => "admin.users.$slug.show",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\UserPersonalDataChangeRequest\UserPersonalDataChangeRequestController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('UserPersonalDataChangeRequestRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\UserPersonalDataChangeRequest\UserPersonalDataChangeRequestController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('UserPersonalDataChangeRequestLayouts');
            });

        View::composer( $this->app->make('UserPersonalDataChangeRequestLayouts'), function($view) {
            return $view->with([
                'routes'  => (object) $this->app->make('UserPersonalDataChangeRequestRoutes'),
                'statuses' => TenderApplicationStatus::get(),
            ]);
        });

    }

}
