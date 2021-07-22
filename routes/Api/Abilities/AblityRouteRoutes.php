<?php

use Illuminate\Support\Facades\Route;

/**
 * --------------------------------------------------------------------------
 * AblityRoute API Routes
 * --------------------------------------------------------------------------
 */

/**
 * AblityRoute api resource routes
 *
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /foo              | index          | foo.index         |
 * | POST         | /foo              | store          | foo.store         |
 * | GET          | /foo/{bar}        | show           | foo.show          |
 * | PUT          | /foo/{bar}        | update         | foo.update        |
 * | DELETE       | /foo/{bar}        | destroy        | foo.destroy       |
 * +--------------+-------------------+----------------+-------------------+
 *
 * @controller FooController
 */

Route::apiResource('ability', 'Abilities\AbilityController');
