<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Image API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Image api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /image            | index          | image.index       |
 * | POST         | /image            | store          | image.store       |
 * | GET          | /image/{id}       | show           | image.show        |
 * | PUT          | /image/{id}       | update         | image.update      |
 * | DELETE       | /image/{id}       | destroy        | image.destroy     |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller Image/ImageApiController
 */

Route::apiResource('image', 'Image\ImageApiController')->middleware('auth:api');
