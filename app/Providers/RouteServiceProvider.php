<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use App\Models\Tender\Tender;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    
    /**
     * This Api namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $apiNamespace = 'App\Http\Controllers\API';
    
    /**
     * This Api namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $webhookNamespace = 'App\Http\Controllers\Webhook';
    
    /**
     * This Api namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $adminNamespace = 'App\Http\Controllers\Admin';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/admin/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        
        Route::bind('user_tender', function ($tender_id) {
            $user = $this->app->auth->guard('api')->user();
            
            return $user->tenders()->findOrFail($tender_id);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebhookRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('/admin')
            ->middleware('web')
            ->namespace($this->adminNamespace)
            ->as('admin.')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $paths = array_merge(
            glob(base_path('routes') . '/Api/*.php'),
            glob(base_path('routes') . '/Api/**/*.php')
        );

        Route::prefix('/api/v1')
            ->middleware('api')
            ->namespace($this->apiNamespace)
            ->group(function($router) use($paths) {
                return collect($paths)->map(function (string $path) {
                    require $path;
                });
            });
    }

    /**
     * Define the "webhook" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapWebhookRoutes()
    {
        $paths = array_merge(
            glob(base_path('routes') . '/Webhook/*.php'),
            glob(base_path('routes') . '/Webhook/**/*.php')
        );

        Route::prefix('/webhook')
            ->middleware('api')
            ->namespace($this->webhookNamespace)
            ->group(function($router) use($paths) {
                return collect($paths)->map(function (string $path) {
                    require $path;
                });
            });
    }

}
