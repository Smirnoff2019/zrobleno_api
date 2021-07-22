<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * PagePost API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * PagePost api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /page             | index          | page.index        |
 * | POST         | /page             | store          | page.store        |
 * | GET          | /page/{page_id}   | show           | page.show         |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller Post\PageApiController
 */

Route::apiResource('page', 'Post\PageApiController')
    ->only([
    'index',
    'store',
    'show'
]);
