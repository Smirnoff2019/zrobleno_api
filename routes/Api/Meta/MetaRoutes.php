<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Meta API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Meta api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /meta             | index          | meta.index        |
 * | POST         | /meta             | store          | meta.store        |
 * | GET          | /meta/{id}        | show           | meta.show         |
 * | PUT          | /meta/{id}        | update         | meta.update       |
 * | DELETE       | /meta/{id}        | destroy        | meta.destroy      |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller App\Http\Controllers\API\Meta\MetaApiController
 */

Route::apiResource('meta', 'Meta\MetaApiController');
