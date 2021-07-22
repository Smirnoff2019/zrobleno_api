<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * WidgetPost API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * WidgetPost api resource routes
 * 
 * +--------------+--------------------+----------------+-------------------+
 * | Method       | URI                | Action         | Route Name        |
 * +--------------+--------------------+----------------+-------------------+
 * | GET          | /widget            | index          | widget.index      |
 * | POST         | /widget            | store          | widget.store      |
 * | GET          | /widget/{widget_id}| show           | widget.show       |
 * +--------------+--------------------+----------------+-------------------+
 * 
 * @controller Post\WidgetApiController
 */

Route::apiResource('widget', 'Post\WidgetApiController')
    ->only([
    'index',
    'store',
    'show'
]);
