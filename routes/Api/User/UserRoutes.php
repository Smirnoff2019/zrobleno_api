<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * User API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * User portfolio api resource routes
 * 
 * +--------------+-------------------------------+----------------+---------------------------+
 * | Method       | URI                           | Action         | Route Name                |
 * +--------------+-------------------------------+----------------+---------------------------+
 * | GET          | /user/{user_id}/portfolio     | index          | user.portfolio.index      |
 * | POST         | /user/{user_id}/portfolio     | store          | user.portfolio.store      |
 * | GET          | /portfolio/{portfolio_id}     | show           | portfolio.show            |
 * | PUT          | /portfolio/{portfolio_id}     | update         | portfolio.update          |
 * | DELETE       | /portfolio/{portfolio_id}     | destroy        | portfolio.destroy         |
 * +--------------+-------------------------------+----------------+---------------------------+
 * 
 * @controller \App\Http\Controllers\API\Portfolio\PortfolioApiController
 */

Route::apiResource('user.portfolio', 'Portfolio\PortfolioApiController')->shallow();
    // ->only([
    //     'index',
    //     'store'
    // ]);

/**
 * User categories application api resource routes
 *
 * +--------------+----------------------------------------+----------------+-----------------------+
 * | Method       | URI                                    | Action         | Route Name            |
 * +--------------+----------------------------------------+----------------+-----------------------+
 * | GET          | /user/{user_id}/categories               | index          | user.categories.index   |
 * | GET          | /user/{user_id}/categories/{category_id} | show           | user.categories.show    |
 * | POST         | /user/{user_id}/categories               | store          | user.categories.store   |
 * | PUT          | /user/{user_id}/categories/{category_id} | update         | user.categories.update  |
 * | DELETE       | /user/{user_id}/categories/{category_id} | store          | user.categories.destroy |
 * +--------------+----------------------------------------+----------------+-----------------------+
 *
 * @controller \App\Http\Controllers\API\Category\CategoryApiController
 */

//Route::apiResource('user.categories', 'Category\CategoryApiController')
//    ->middleware('auth:api');

/** 
 * User tenders api resource routes
 * 
 * +--------------+---------------------------+----------------+----------------------+
 * | Method       | URI                       | Action         | Route Name           |
 * +--------------+---------------------------+----------------+----------------------+
 * | GET          | /user/{user_id}/tender    | index          | user.tender.index    |
 * | POST         | /user/{user_id}/tender    | store          | user.tender.store    |
 * +--------------+---------------------------+----------------+----------------------+
 * 
 * @controller \App\Http\Controllers\API\User\Tender\TenderApiController
 */

Route::apiResource('user.tender', 'User\Tender\TenderApiController')
    ->only([
        'index',
        'store'
    ]);

/** 
 * User tenders applications api resource routes
 * 
 * +--------------+--------------------------------------+----------------+----------------------------------+
 * | Method       | URI                                  | Action         | Route Name                       |
 * +--------------+--------------------------------------+----------------+----------------------------------+
 * | GET          | /user/{user_id}/tender_application   | index          | user.tender_application.index    |
 * | POST         | /user/{user_id}/tender_application   | store          | user.tender_application.store    |
 * +--------------+--------------------------------------+----------------+----------------------------------+
 * 
 * @controller \App\Http\Controllers\API\User\TenderApplication\TenderApplicationApiController
 */

Route::apiResource('user.tender_application', 'User\TenderApplication\TenderApplicationApiController')
    ->only([
        'index',
        'store'
    ]);

/** 
 * User tenders applications api resource routes
 * 
 * +--------------+--------------------------------------+----------------+----------------------------------+
 * | Method       | URI                                  | Action         | Route Name                       |
 * +--------------+--------------------------------------+----------------+----------------------------------+
 * | GET          | /user/{user_id}/discount_card        | index          | user.discount_card.index         |
 * | POST         | /user/{user_id}/discount_card        | store          | user.discount_card.store         |
 * +--------------+--------------------------------------+----------------+----------------------------------+
 * 
 * @controller \App\Http\Controllers\API\User\DiscountCard\DiscountCardApiController
 */

Route::apiResource('user.discount_card', 'User\DiscountCard\DiscountCardApiController')
    ->only([
        'index',
        'store'
    ]);

/**
 * User complaints application api resource routes
 *
 * +--------------+------------------------------------------+----------------+------------------------+
 * | Method       | URI                                      | Action         | Route Name             |
 * +--------------+------------------------------------------+----------------+------------------------+
 * | GET          | /user/{user_id}/complaint                | index          | user.complaint.index   |
 * | GET          | /user/{user_id}/complaint/{complaint_id} | show           | user.complaint.show    |
 * | POST         | /user/{user_id}/complaint                | store          | user.complaint.store   |
 * | PUT          | /user/{user_id}/complaint/{complaint_id} | update         | user.complaint.update  |
 * | DELETE       | /user/{user_id}/complaint/{complaint_id} | store          | user.complaint.destroy |
 * +--------------+------------------------------------------+----------------+------------------------+
 *
 * @controller \App\Http\Controllers\API\Complaint\ComplaintApiController
 */

Route::apiResource('user.complaint', 'Complaint\ComplaintApiController')
    ->middleware('auth:api');

/**
 * User complaint answers application api resource routes
 *
 * +--------------+----------------------------------------------------------------+----------+------------------------+
 * | Method       | URI                                                            | Action   | Route Name             |
 * +--------------+----------------------------------------------------------------+----------+------------------------+
 * | GET          | /user/{user_id}/complaint/{complaint_id}/response              | index    | user.response.index    |
 * | GET          | /user/{user_id}/complaint/{complaint_id}/response/{response_id}| show     | user.response.show     |
 * | POST         | /user/{user_id}/complaint/{complaint_id}/response              | store    | user.response.store    |
 * | PUT          | /user/{user_id}/complaint/{complaint_id}/response/{response_id}| update   | user.response.update   |
 * | DELETE       | /user/{user_id}/complaint/{complaint_id}/response/{response_id}| store    | user.response.destroy  |
 * +--------------+----------------------------------------------------------------+----------+------------------------+
 *
 * @controller \App\Http\Controllers\API\Complaint\ComplaintApiController
 */

Route::apiResource('user.complaint.response', 'Complaint\ComplaintResponse\ComplaintResponseApiController')
    ->middleware('auth:api')
    ->only([
        'index',
        'show',
        'store',
        'update',
    ]);
Route::put(
    '/user/{user_id}/complaint/{complaint_id}/response/{response_id}/satisfied',
    'Complaint\ComplaintResponse\ComplaintResponseApiController@satisfied'
)
    ->middleware('auth:api')
    ->name('user.complaint.response.satisfied');
Route::put(
    '/user/{user_id}/complaint/{complaint_id}/response/{response_id}/rejected',
    'Complaint\ComplaintResponse\ComplaintResponseApiController@rejected'
)
    ->middleware('auth:api')
    ->name('user.response.rejected');

/**
 * User images applications api resource routes
 *
 * +--------------+----------------------------+----------------+----------------------+
 * | Method       | URI                        | Action         | Route Name           |
 * +--------------+----------------------------+----------------+----------------------+
 * | GET          | /user/{user_id}/image      | index          | user.image.index     |
 * | POST         | /user/{user_id}/image      | store          | user.image.store     |
 * +--------------+----------------------------+----------------+----------------------+
 *
 * @controller \App\Http\Controllers\API\User\Image\ImageApiController
 */

Route::apiResource('user.image', 'User\Image\ImageApiController')
    ->only([
        'index',
        'store'
    ]);

/**
 * User files applications api resource routes
 *
 * +--------------+----------------------------+----------------+----------------------+
 * | Method       | URI                        | Action         | Route Name           |
 * +--------------+----------------------------+----------------+----------------------+
 * | GET          | /user/{user_id}/file       | index          | user.file.index      |
 * | POST         | /user/{user_id}/file       | store          | user.file.store      |
 * +--------------+----------------------------+----------------+----------------------+
 *
 * @controller \App\Http\Controllers\API\User\File\UserImageApiController
 */

Route::apiResource('user.file', 'User\File\UserFileApiController')
    ->only([
        'index',
        'store'
    ]);

/**
 * Auth user images applications api resource routes
 *
 * +--------------+------------------+----------------+------------------------+
 * | Method       | URI              | Action         | Route Name             |
 * +--------------+------------------+----------------+------------------------+
 * | GET          | /user/image      | index          | auth.user.image.index  |
 * | POST         | /user/image      | store          | auth.user.image.store  |
 * +--------------+------------------+----------------+------------------------+
 *
 * @controller \App\Http\Controllers\API\User\Image\AuthUserImageApiController
 */

Route::apiResource('user/image', 'User\Image\AuthUserImageApiController')
    ->only([
        'index',
        'store'
    ]);

/**
 * Contractor tenders api resource routes
 *
 * +--------------+-------------------------------------------+--------------+-------------------------------+
 * | Method       | URI                                       | Action       | Route Name                    |
 * +--------------+-------------------------------------------+--------------+-------------------------------+
 * | GET          | /contractor/{user_id}/tender              | index        | contractor.tender.index       |
 * | GET          | /contractor/{user_id}/tender/available    | available    | contractor.tender.available   |
 * +--------------+-------------------------------------------+--------------+-------------------------------+
 *
 * @controller API\Contractor\Tender\TenderApiController
 */

// Route::get('contractor.tender', 'Contractor\Tender\TenderApiController@index')->name("contractor.tender.index");
// Route::get('contractor.tender/available', 'Contractor\Tender\TenderApiController@available')->name("contractor.tender.available");

/**
 * Users api resource routes
 *
 * +--------------+------------------------+----------------+-------------------+
 * | Method       | URI                    | Action         | Route Name        |
 * +--------------+------------------------+----------------+-------------------+
 * | GET          | /user                  | index          | user.index        |
 * | POST         | /user                  | store          | user.store        |
 * | GET          | /user/{user_id}        | show           | user.show         |
 * | PUT          | /user/{user_id}        | update         | user.update       |
 * | DELETE       | /user/{user_id}        | destroy        | user.destroy      |
 * +--------------+------------------------+----------------+-------------------+
 *
 * @controller \App\Http\Controllers\API\User\UserController
 */

Route::apiResource('user', 'User\UserController');
