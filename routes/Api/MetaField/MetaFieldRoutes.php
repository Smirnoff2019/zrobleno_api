<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * MetaField API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * MetaField api resource routes
 * 
 * +--------------+---------------------------+----------------+---------------------+
 * | Method       | URI                       | Action         | Route Name          |
 * +--------------+---------------------------+----------------+---------------------+
 * | GET          | /metaField                | index          | metaField.index     |
 * | POST         | /metaField                | store          | metaField.store     |
 * | GET          | /metaField/{id}           | show           | metaField.show      |
 * | PUT          | /metaField/{id}           | update         | metaField.update    |
 * | DELETE       | /metaField/{id}           | destroy        | metaField.destroy   |
 * +--------------+---------------------------+----------------+---------------------+
 * 
 * @controller Meta/MetaField/MetaFieldApiController
 */

Route::apiResource('metaField', 'Meta\MetaField\MetaFieldApiController');
