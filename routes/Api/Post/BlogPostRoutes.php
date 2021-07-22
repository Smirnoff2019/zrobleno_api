<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * BlogPost API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * BlogPost api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /blog             | index          | blog.index        |
 * | POST         | /blog             | store          | blog.store        |
 * | GET          | /blog/{blog_id}   | show           | blog.show         |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller Post\BlogApiController
 */

Route::apiResource('blog', 'Post\BlogApiController')
    ->only([
    'index',
    'store',
    'show'
]);
