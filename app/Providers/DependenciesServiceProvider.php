<?php

namespace App\Providers;

use App\Models\Tender\Tender;
use App\Models\User\Customer\Customer;
use Illuminate\Support\ServiceProvider;
use App\Models\User\Contractor\Contractor;
use App\Http\Controllers\API\Contractor\Tenders\TendersApiController as Contractor_TendersApiController;
use App\Http\Controllers\API\Contractor\Tenders\Deals\TenderDealsApiController as Contractor_TenderDealsApiController;
use App\Http\Controllers\API\Customer\Tenders\TendersApiController as Customer_TendersApiController;
use App\Models\CalculatorOption\Coefficient;
use App\Models\Role\ContractorRole;
use App\Models\Role\CustomerRole;
use Illuminate\Support\Facades\View;

class DependenciesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $user = $this->app->auth->guard('api')->user();
        
        if($user !== null) {

            switch ($user->role->slug) {
                case ContractorRole::DEFAULT_SLUG:
                    $user = Contractor::findOrFail($user->id);
                    // $this->app->auth->guard('api')->setUser($user);
                    break;
                case CustomerRole::DEFAULT_SLUG:
                    $user = Customer::findOrFail($user->id);
                    // $this->app->auth->guard('api')->setUser($user);
                    break;
                
                default:
                    # code...
                    break;
            }

            $this->app
                ->when([Contractor_TendersApiController::class])
                ->needs(Customer::class)
                ->give(function($app) {
                    return Customer::findOrFail($app->request->route('customer_id'));
                });
            
            $this->app
                ->when([
                    Contractor_TendersApiController::class,
                    Contractor_TenderDealsApiController::class
                ])
                ->needs(Contractor::class)
                ->give(function($app) use($user) {
                    return $user->isContractor() ? $user : Contractor::getModel();
                });

            // $this->app
            //     ->when([
            //         Contractor_TenderDealsApiController::class
            //     ])
            //     ->needs(Tender::class)
            //     ->give(function($app) use($user) {
            //         return $user->tenders()->findOrFail($app->request->route('tender_id'));
            //     });

            $this->app
                ->when([Customer_TendersApiController::class])
                ->needs(Customer::class)
                ->give(function($app) use($user) {
                    return $user->isCustomer() ? $user : Customer::getModel();
                });

        }

        $this->app
            ->when([\App\Services\CalculatorService::class])
            ->needs('$coefficients')
            ->give(function($app) {
                return Coefficient::get();
            });
        
        View::composer(
            [
                'admin.calculator-settings.coefficient-index', 
                'admin.calculator-settings.coefficient-edit',
                'includes.coefficient-nav-card'
            ],
            function($view) {
                return $view->with([
                    'index_route'  => 'admin.calculator-settings.coefficient.index',
                    'store_route'  => 'admin.calculator-settings.coefficient.store',
                    'edit_route'   => 'admin.calculator-settings.coefficient.edit',
                    'update_route' => 'admin.calculator-settings.coefficient.update',
                ]);
            }
        );

    }
}