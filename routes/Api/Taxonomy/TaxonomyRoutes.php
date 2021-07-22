<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Taxonomy API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Taxonomy api resource routes
 * 
 * +--------------+-------------------------+----------------+-------------------+
 * | Method       | URI                     | Action         | Route Name        |
 * +--------------+-------------------------+----------------+-------------------+
 * | GET          | /taxonomy               | index          | taxonomy.index    |
 * | POST         | /taxonomy               | store          | taxonomy.store    |
 * | GET          | /taxonomy/{id}          | show           | taxonomy.show     |
 * | PUT          | /taxonomy/{id}          | update         | taxonomy.update   |
 * | DELETE       | /taxonomy/{id}          | destroy        | taxonomy.destroy  |
 * +--------------+-------------------------+----------------+-------------------+
 * 
 * @controller App\Http\Controllers\API\Taxonomy\TaxonomyApiController
 */

Route::apiResource('taxonomy', 'Taxonomy\TaxonomyApiController');
