<?php

use Illuminate\Support\Facades\Route;

/**
 * --------------------------------------------------------------------------
 * Permission API Routes
 * --------------------------------------------------------------------------
 */

/**
 * Permission api resource routes
 *
 * +--------------+--------------------------+----------------+--------------------------+
 * | Method       | URI                      | Action         | Route Name               |
 * +--------------+--------------------------+----------------+--------------------------+
 * | GET          | /permission              | index          | permission.index         |
 * | POST         | /permission              | store          | permission.store         |
 * | GET          | /permission/{id}         | show           | permission.show          |
 * | PUT          | /permission/{id}         | update         | permission.update        |
 * | DELETE       | /permission/{id}         | destroy        | permission.destroy       |
 * +--------------+--------------------------+----------------+--------------------------+
 *
 * @controller \App\Http\Controllers\Api\Permissions\PermissionController
 */

Route::apiResource('permission', 'Permissions\PermissionController');
