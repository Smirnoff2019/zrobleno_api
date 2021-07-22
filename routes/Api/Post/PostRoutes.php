<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Post API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Post api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /post             | index          | post.index        |
 * | POST         | /post             | store          | post.store        |
 * | GET          | /post/{id}        | show           | post.show         |
 * | PUT          | /post/{id}        | update         | post.update       |
 * | DELETE       | /post/{id}        | destroy        | post.destroy      |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller App\Http\Controllers\API\Post\PostApiController
 */

Route::apiResource('post', 'Post\PostApiController');
