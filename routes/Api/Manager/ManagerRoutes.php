<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Manager API Routes
 * --------------------------------------------------------------------------
 */
 

Route::group([
    'prefix' => 'manager',
    'middleware' => [
        'auth:api',
        'role:manager'
    ],
    'name' => 'manager.'
], function () {

    /**
     * manager tenders api resource routes
     *
     * +--------------+--------------------------------------------+----------------+----------------------------------+
     * | Method       | URI                                        | Action         | Route Name                       |
     * +--------------+--------------------------------------------+----------------+----------------------------------+
     * | GET          | /manager/tenders/                         | index          | manager.tenders.index           |
     * | GET          | /manager/tenders/                         | index          | manager.tenders.activate           |
     * | GET          | /manager/tenders/{tender_id}              | show           | manager.tenders.show            |
     * +--------------+--------------------------------------------+----------------+----------------------------------+
     *
     * @controller \App\Http\Controllers\API\Customer\Tenders\TendersApiController
     */
    Route::name('manager.tenders.')->group(function() {

        Route::get('/tenders', 'Manager\Tenders\TendersApiController@index')
            ->name("index");

        Route::post('/tenders/{tender}/activate', 'Manager\Tenders\TendersApiController@activate')
            ->name("activate");
        
        // Route::get('/tenders/{user_tender}', 'Customer\Tenders\TendersApiController@show')
        //     ->name("show");
    
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
        // Route::name('deals.')
        //     ->prefix('/tenders/{user_tender}/deals')
        //     ->group(function() {

        //         Route::post('/offer', 'Customer\Tenders\Deals\TenderDealsApiController@offer')
        //             ->name("offer");

        // });
    
        /**
         * Contractor restart tenders api resource routes
         *
         * +----------+-----------------------------------------------------+-------------+-----------------------------------+
         * | Method   | URI                                                 | Action      | Route Name                        |
         * +----------+-----------------------------------------------------+-------------+-----------------------------------+
         * | POST     | /customer/tenders/{tender_id}/restart/offer         | restart     | customer.tenders.deals.restart    |
         * +----------+-----------------------------------------------------+-------------+-----------------------------------+
         *
         * @controller \App\Http\Controllers\API\Customer\Tenders\TendersApiController@restart
         */
        // Route::name('restart.')
        //     ->prefix('/tenders/{user_tender}/restart')
        //     ->group(function() {

        //         Route::post('/offer', 'Customer\Tenders\TendersApiController@restart')
        //             ->name("restart");

        // });
    
        /**
         * Contractor tenders application api resource routes
         *
         * +----------+-----------------------------------------------------+-------------+-------------------------------------------+
         * | Method   | URI                                                 | Action      | Route Name                                |
         * +----------+-----------------------------------------------------+-------------+-------------------------------------------+
         * | POST     | /manager/tenders/{tender_id}/application/confirm    | confirm     | manager.tenders.application.confirm       |
         * | POST     | /manager/tenders/{tender_id}/application/reject     | reject      | manager.tenders.application.reject        |
         * +----------+-----------------------------------------------------+-------------+-------------------------------------------+
         *
         * @controller \App\Http\Controllers\API\Customer\Tenders\Applications\TenderApplicationApiController
         */
        Route::name('application.')
            ->prefix('/tenders/{tender}/application')
            ->group(function() {

                Route::post('/confirm', 'Manager\Tenders\Applications\TenderApplicationApiController@confirm')
                    ->name("confirm");

                Route::post('/reject', 'Manager\Tenders\Applications\TenderApplicationApiController@reject')
                    ->name("reject");

        });

    });


});
