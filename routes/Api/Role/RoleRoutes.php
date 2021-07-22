<?php

use Illuminate\Support\Facades\Route;

/**
 * --------------------------------------------------------------------------
 * Role API Routes
 * --------------------------------------------------------------------------
 */

 
/**
 * Role permissions api resource routes
 *
 * +--------------+----------------------------------------------------+----------------+-----------------------------+
 * | Method       | URI                                                | Action         | Route Name                  |
 * +--------------+----------------------------------------------------+----------------+-----------------------------+
 * | PUT          | /role/{role_id}/permissions/{permission_id}        | update         | role.permissions.update     |
 * +--------------+----------------------------------------------------+----------------+-----------------------------+
 *
 * @controller \App\Http\Controllers\Api\Role\Permissions\PermissionController
 */

Route::put('role/{role_id}/permissions', 'Role\Permissions\PermissionController@update')->name('role.permissions.update');


/**
 * Role api resource routes
 *
 * +--------------+------------------------+----------------+--------------------+
 * | Method       | URI                    | Action         | Route Name         |
 * +--------------+------------------------+----------------+--------------------+
 * | GET          | /role                  | index          | role.index         |
 * | GET          | /role/{role_id}        | show           | role.show          |
 * | PUT          | /role/{role_id}        | update         | role.update        |
 * +--------------+------------------------+----------------+--------------------+
 *
 * @controller \App\Http\Controllers\Api\Roles\RoleController
 */

Route::apiResource('role', 'Role\RoleApiController')
    ->except([
        'store',
        'destroy'
    ]);
