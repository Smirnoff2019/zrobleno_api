<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * MenuPost API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * MenuPost api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /menu             | index          | menu.index        |
 * | POST         | /menu             | store          | menu.store        |
 * | GET          | /menu/{menu_id}   | show           | menu.show         |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller Post\MenuApiController
 */

Route::apiResource('menu', 'Post\MenuApiController')
    ->only([
    'index',
    'store',
    'show'
]);
