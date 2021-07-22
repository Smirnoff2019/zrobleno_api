<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Room API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Room api resource routes
 * 
 * +--------------+--------------------+----------------+--------------------+
 * | Method       | URI                | Action         | Route Name         |
 * +--------------+--------------------+----------------+--------------------+
 * | GET          | /room              | index          | room.index         |
 * | POST         | /room              | store          | room.store         |
 * | GET          | /room/{id}         | show           | room.show          |
 * | PUT          | /room/{id}         | update         | room.update        |
 * | DELETE       | /room/{id}         | destroy        | room.destroy       |
 * +--------------+--------------------+----------------+--------------------+
 * 
 * @controller \App\Http\Controllers\API\Room\RoomController
 */

Route::apiResource('room', 'Room\RoomController');
