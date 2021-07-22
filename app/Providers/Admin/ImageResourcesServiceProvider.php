<?php

namespace App\Providers\Admin;

use App\Models\ImagesGroup\ImagesGroup;
use App\Models\Status\CommonStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ImageResourcesServiceProvider extends ServiceProvider
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
        $slug = 'images';
        
        $this->app->bind('ImageRoutes', function ($app) use($slug) {
            return [
                'index'   => "admin.$slug.index",
                'store'   => "admin.$slug.store",
                'create'  => "admin.$slug.create",
                'edit'    => "admin.$slug.edit",
                'update'  => "admin.$slug.update",
                'destroy' => "admin.$slug.destroy",
            ];
        });

        $this->app->bind('ImageLayouts', function ($app) use($slug) {
            return [
                'index'           => "admin.$slug.index",
                'create'          => "admin.$slug.create",
                'edit'            => "admin.$slug.edit",
                'modal-edit-form' => "admin.runtime.modal-image-edit-form",
            ];
        });

        $this->app
            ->when([\App\Http\Controllers\Admin\Image\ImageController::class])
            ->needs('$routes')
            ->give(function($app) {
                return $this->app->make('ImageRoutes');
            });

        $this->app
            ->when([\App\Http\Controllers\Admin\Image\ImageController::class])
            ->needs('$layouts')
            ->give(function($app) {
                return $this->app->make('ImageLayouts');
            });

        View::composer( $this->app->make('ImageLayouts'), function($view) {
            return $view->with([
                'routes'       => (object) $this->app->make('ImageRoutes'),
                'imagesGroups' => ImagesGroup::get(),
                'statuses'     => CommonStatus::all(),
            ]);
        });

    }

}
