<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Tender API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * TenderApplication api resource routes
 * 
 * +--------------+----------------------------+----------------+------------------------------+
 * | Method       | URI                        | Action         | Route Name                   |
 * +--------------+----------------------------+----------------+------------------------------+
 * | GET          | /tender/application        | index          | tender.application.index     |
 * | POST         | /tender/application        | store          | tender.application.store     |
 * | GET          | /tender/application/{id}   | show           | tender.application.show      |
 * | PUT          | /tender/application/{id}   | update         | tender.application.update    |
 * | DELETE       | /tender/application/{id}   | destroy        | tender.application.destroy   |
 * +--------------+----------------------------+----------------+------------------------------+
 * 
 * @controller \App\Http\Controllers\API\TenderApplication\TenderApplicationApiController
 */

Route::apiResource('tender/application', 'TenderApplication\TenderApplicationApiController');

/** 
 * TenderApplication api resource routes
 * 
 * +--------------+----------------------------+----------------+------------------------------+
 * | Method       | URI                        | Action         | Route Name                   |
 * +--------------+----------------------------+----------------+------------------------------+
 * | GET          | /tender/user               | index          | tender.user.index     |
 * | POST         | /tender/user               | store          | tender.user.store     |
 * | GET          | /tender/user/{id}          | show           | tender.user.show      |
 * | PUT          | /tender/user/{id}          | update         | tender.user.update    |
 * | DELETE       | /tender/user/{id}          | destroy        | tender.user.destroy          |
 * +--------------+----------------------------+----------------+------------------------------+
 * 
 * @controller \App\Http\Controllers\API\TenderApplication\TenderApplicationApiController
 */

Route::apiResource('tender/user', 'TenderApplication\TenderApplicationApiController');


/** 
 * Tender api resource routes
 * 
 * +--------------+----------------------+----------------+--------------------+
 * | Method       | URI                  | Action         | Route Name         |
 * +--------------+----------------------+----------------+--------------------+
 * | GET          | /tender              | index          | tender.index       |
 * | POST         | /tender              | store          | tender.store       |
 * | GET          | /tender/{id}         | show           | tender.show        |
 * | PUT          | /tender/{id}         | update         | tender.update      |
 * | DELETE       | /tender/{id}         | destroy        | tender.destroy     |
 * +--------------+----------------------+----------------+--------------------+
 * 
 * @controller \App\Http\Controllers\API\Tender\TenderApiController
 */

Route::apiResource('tender', 'Tender\TenderApiController');
