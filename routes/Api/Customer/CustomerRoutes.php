<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Tender API Routes
 * --------------------------------------------------------------------------
 */
 

Route::group([
    'prefix' => 'customer',
    'middleware' => [
        'auth:api',
        'role:customer'
    ],
    'name' => 'customer.'
], function () {

    /**
     * Customer tenders api resource routes
     *
     * +--------------+--------------------------------------------+----------------+----------------------------------+
     * | Method       | URI                                        | Action         | Route Name                       |
     * +--------------+--------------------------------------------+----------------+----------------------------------+
     * | GET          | /customer/tenders/                         | index          | customer.tenders.index           |
     * | GET          | /customer/tenders/{tender_id}              | show           | customer.tenders.show            |
     * +--------------+--------------------------------------------+----------------+----------------------------------+
     *
     * @controller \App\Http\Controllers\API\Customer\Tenders\TendersApiController
     */
    Route::name('tenders.')->group(function() {

        Route::get('/tenders', 'Customer\Tenders\TendersApiController@index')
            ->name("index");

        Route::get('/tenders/initialized', 'Customer\Tenders\TendersApiController@initialized')
            ->name("initialized");
        
        Route::get('/tenders/{user_tender}', 'Customer\Tenders\TendersApiController@show')
            ->name("show");
        
        Route::post('/tenders/create', 'Customer\Tenders\TendersApiController@store')
            ->name("store");
    
        /**
         * Customer tenders deals api resource routes
         *
         * +----------+-----------------------------------------------------+------------+-----------------------------------+
         * | Method   | URI                                                 | Action     | Route Name                        |
         * +----------+-----------------------------------------------------+------------+-----------------------------------+
         * | POST     | /customer/tenders/{tender_id}/deals/offer           | offer      | customer.tenders.deals.offer      |
         * +----------+-----------------------------------------------------+------------+-----------------------------------+
         *
         * @controller \App\Http\Controllers\API\Customer\Tenders\Deals\TenderDealsApiController
         */
        Route::name('deals.')
            ->prefix('/tenders/{user_tender}/deals')
            ->group(function() {

                Route::post('/offer', 'Customer\Tenders\Deals\TenderDealsApiController@offer')
                    ->name("offer");

        });
    
        /**
         * Contractor restart tenders api resource routes
         *
         * +----------+-----------------------------------------------------+-------------+-----------------------------------+
         * | Method   | URI                                                 | Action      | Route Name                        |
         * +----------+-----------------------------------------------------+-------------+-----------------------------------+
         * | POST     | /customer/tenders/{tender_id}/restart/offer         | restart     | customer.tenders.restart.offer    |
         * +----------+-----------------------------------------------------+-------------+-----------------------------------+
         *
         * @controller \App\Http\Controllers\API\Customer\Tenders\TendersApiController@restart
         */
        Route::name('restart.')
            ->prefix('/tenders/{user_tender}/restart')
            ->group(function() {

                Route::post('/offer', 'Customer\Tenders\TendersApiController@restart')
                    ->name("offer");

        });
    
        /**
         * Contractor tenders application api resource routes
         *
         * +----------+-----------------------------------------------------+-------------+-----------------------------------------+
         * | Method   | URI                                                 | Action      | Route Name                              |
         * +----------+-----------------------------------------------------+-------------+-----------------------------------------+
         * | POST     | /customer/tenders/{tender_id}/application/cancel    | cancel      | customer.tenders.application.cancel     |
         * +----------+-----------------------------------------------------+-------------+-----------------------------------------+
         *
         * @controller \App\Http\Controllers\API\Customer\Tenders\Applications\TenderApplicationApiController
         */
        Route::name('application.')
            ->prefix('/tenders/{user_tender}/application')
            ->group(function() {

                Route::post('/cancel', 'Customer\Tenders\Applications\TenderApplicationApiController@cancel')
                    ->name("cancel");

        });

    });


});
