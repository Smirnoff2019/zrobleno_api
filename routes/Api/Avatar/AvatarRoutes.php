<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Avatar API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Avatar api resource routes
 * 
 * +--------------+--------------------+----------------+--------------------+
 * | Method       | URI                | Action         | Route Name         |
 * +--------------+--------------------+----------------+--------------------+
 * | GET          | /avatars            | index          | avatars.index       |
 * | POST         | /avatars            | store          | avatars.store       |
 * | GET          | /avatars/{id}       | show           | avatars.show        |
 * | PUT          | /avatars/{id}       | update         | avatars.update      |
 * | DELETE       | /avatars/{id}       | destroy        | avatars.destroy     |
 * +--------------+--------------------+----------------+--------------------+
 * 
 * @controller \App\Http\Controllers\API\Avatar\AvatarController
 */

Route::apiResource('/avatars', 'Avatar\AvatarController');
