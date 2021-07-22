<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Category API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Category api resource routes
 * 
 * +--------------+-------------------------+----------------+-------------------+
 * | Method       | URI                     | Action         | Route Name        |
 * +--------------+-------------------------+----------------+-------------------+
 * | GET          | /categories               | index          | categories.index    |
 * | POST         | /categories               | store          | categories.store    |
 * | GET          | /categories/{id}          | show           | categories.show     |
 * | PUT          | /categories/{id}          | update         | categories.update   |
 * | DELETE       | /categories/{id}          | destroy        | categories.destroy  |
 * +--------------+-------------------------+----------------+-------------------+
 * 
 * @controller App\Http\Controllers\API\Category\CategoryApiController
 */

Route::apiResource('categories', 'Category\CategoryApiController');
