<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Tender API Routes
 * --------------------------------------------------------------------------
 */
 

Route::group([
    'prefix' => 'contractor',
    'middleware' => [
        'auth:api',
        'role:contractor'
    ],
    'name' => 'contractor.'
], function () {

    /**
     * Contractor tenders api resource routes
     *
     * +--------------+----------------------------------------------+----------------+------------------------------------+
     * | Method       | URI                                          | Action         | Route Name                         |
     * +--------------+----------------------------------------------+----------------+------------------------------------+
     * | GET          | /contractor/tenders/                         | index          | contractor.tenders.index           |
     * | GET          | /contractor/tenders/available                | available      | contractor.tenders.available       |
     * | GET          | /contractor/tenders/{tender_id}              | show           | contractor.tenders.show            |
     * | POST         | /contractor/tenders/{tender_id}/buy          | buy            | contractor.tenders.buy             |
     * | POST         | /contractor/tenders/customer/{customer}      | forCustomer    | contractor.tenders.forCustomer     |
     * +--------------+----------------------------------------------+----------------+------------------------------------+
     *
     * @controller \App\Http\Controllers\API\Contractor\Tenders\TendersApiController
     */
    Route::name('tenders.')->group(function() {

        Route::get('/tenders', 'Contractor\Tenders\TendersApiController@index')
            ->name("index");
        
        Route::get('/tenders/available', 'Contractor\Tenders\TendersApiController@available')
            ->name("available");
        
        Route::get('/tenders/{tender}', 'Contractor\Tenders\TendersApiController@show')
            ->where(['tender' => '[0-9]+'])
            ->name("show");
        
        Route::post('/tenders/{tender}/buy', 'Contractor\Tenders\TendersApiController@buy')
            ->where(['tender' => '[0-9]+'])
            ->name("buy");
        
        Route::get('/tenders/customer/{customer}', 'Contractor\Tenders\TendersApiController@forCustomer')
            ->where(['customer' => '[0-9]+'])
            ->name("forCustomer");

    
        /**
         * Contractor tenders api resource routes
         *
         * +--------------+-----------------------------------------------------+----------------+---------------------------------------+
         * | Method       | URI                                                 | Action         | Route Name                            |
         * +--------------+-----------------------------------------------------+----------------+---------------------------------------+
         * | POST         | /contractor/tenders/{tender_id}/deals/offer         | offer          | contractor.tenders.deals.offer        |
         * | POST         | /contractor/tenders/{tender_id}/deals/confirm       | confirm        | contractor.tenders.deals.confirm      |
         * | POST         | /contractor/tenders/{tender_id}/deals/reject        | reject         | contractor.tenders.deals.reject       |
         * +--------------+-----------------------------------------------------+----------------+---------------------------------------+
         *
         * @controller \App\Http\Controllers\API\Contractor\Tenders\Deals\TenderDealsApiController
         */
        Route::name('deals.')
            ->prefix('/tenders/{tender}/deals')
            ->where(['tender' => '[0-9]+'])
            ->group(function() {

            Route::post('/offer', 'Contractor\Tenders\Deals\TenderDealsApiController@offer')
                ->name("offer");

            Route::post('/confirm', 'Contractor\Tenders\Deals\TenderDealsApiController@confirm')
                ->name("confirm");

            Route::post('/reject', 'Contractor\Tenders\Deals\TenderDealsApiController@reject')
                ->name("reject");

        });

    });


});
