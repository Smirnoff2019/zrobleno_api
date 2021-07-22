<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * FormPost API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * FormPost api resource routes
 * 
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /form             | index          | form.index        |
 * | POST         | /form             | store          | form.store        |
 * | GET          | /form/{form_id}   | show           | form.show         |
 * +--------------+-------------------+----------------+-------------------+
 * 
 * @controller Post\FormApiController
 */

Route::apiResource('form', 'Post\FormApiController')
    ->only([
    'index',
    'store',
    'show'
]);
