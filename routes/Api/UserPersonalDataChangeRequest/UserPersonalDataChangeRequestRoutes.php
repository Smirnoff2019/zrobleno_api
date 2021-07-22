<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * UserPersonalDataChangeRequest API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * UserPersonalDataChangeRequest api resource routes
 * 
 * +--------------+--------------------------------------+---------+----------------------------------------+
 * | Method       | URI                                  | Action  | Route Name                             |
 * +--------------+--------------------------------------+---------+----------------------------------------+
 * | GET          | /userPersonalDataChangeRequests      | index   | userPersonalDataChangeRequests.index   |
 * | POST         | /userPersonalDataChangeRequests      | store   | userPersonalDataChangeRequests.store   |
 * | GET          | /userPersonalDataChangeRequests/{id} | show    | userPersonalDataChangeRequests.show    |
 * | PUT          | /userPersonalDataChangeRequests/{id} | update  | userPersonalDataChangeRequests.update  |
 * | DELETE       | /userPersonalDataChangeRequests/{id} | destroy | userPersonalDataChangeRequests.destroy |
 * +--------------+--------------------------------------+---------+----------------------------------------+
 * 
 * @controller UserPersonalDataChangeRequest/UserPersonalDataChangeRequestApiController
 */

Route::apiResource(
    'userPersonalDataChangeRequests',
    'User\UserPersonalDataChangeRequest\UserPersonalDataChangeRequestApiController');

Route::put(
    '/userPersonalDataChangeRequests/{id}/confirm',
    'User\UserPersonalDataChangeRequest\UserPersonalDataChangeRequestApiController@confirm'
)
    ->middleware('auth:api')
    ->name('userPersonalDataChangeRequests.confirm');
Route::put(
    '/userPersonalDataChangeRequests/{id}/reject',
    'User\UserPersonalDataChangeRequest\UserPersonalDataChangeRequestApiController@reject'
)
    ->middleware('auth:api')
    ->name('userPersonalDataChangeRequests.reject');
