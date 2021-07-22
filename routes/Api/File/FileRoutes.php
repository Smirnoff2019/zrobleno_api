<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * File API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * File api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /file             | index          | file.index        |
 * | POST         | /file             | store          | file.store        |
 * | GET          | /file/{id}        | show           | file.show         |
 * | PUT          | /file/{id}        | update         | file.update       |
 * | DELETE       | /file/{id}        | destroy        | file.destroy      |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller File\FileApiController
 */

Route::apiResource('file', 'File\FileApiController');
