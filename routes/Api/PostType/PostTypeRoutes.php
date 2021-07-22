<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * PostType API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * PostType api resource routes
 * 
 * +--------------+-------------------------+----------------+-------------------+
 * | Method       | URI                     | Action         | Route Name        |
 * +--------------+-------------------------+----------------+-------------------+
 * | GET          | /postType               | index          | postType.index    |
 * | POST         | /postType               | store          | postType.store    |
 * | GET          | /postType/{id}          | show           | postType.show     |
 * | PUT          | /postType/{id}          | update         | postType.update   |
 * | DELETE       | /postType/{id}          | destroy        | postType.destroy  |
 * +--------------+-------------------------+----------------+-------------------+
 * 
 * @controller Post\PostTypes\PostTypeApiController
 */

Route::apiResource('postType', 'Post\PostTypes\PostTypeApiController');
