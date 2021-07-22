<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * Project property condition API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Project property condition api resource routes
 * 
 * +--------------+------------------------------------+----------------+---------------------------------------+
 * | Method       | URI                                | Action         | Route Name                            |
 * +--------------+------------------------------------+----------------+---------------------------------------+
 * | GET          | /project/propertyCondition         | index          | project.propertyCondition.index       |
 * | POST         | /project/propertyCondition         | store          | project.propertyCondition.store       |
 * | GET          | /project/propertyCondition/{id}    | show           | project.propertyCondition.show        |
 * | PUT          | /project/propertyCondition/{id}    | update         | project.propertyCondition.update      |
 * | DELETE       | /project/propertyCondition/{id}    | destroy        | project.propertyCondition.destroy     |
 * +--------------+------------------------------------+----------------+---------------------------------------+
 * 
 * @controller \App\Http\Controllers\API\ProjectPropertyCondition\ProjectPropertyConditionController
 */

Route::apiResource('project/propertyCondition', "ProjectPropertyCondition\ProjectPropertyConditionController");


/** 
 * --------------------------------------------------------------------------
 * Project API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * Project api resource routes
 * 
 * +--------------+----------------------+----------------+-----------------+
 * | Method       | URI              | Action         | Route Name          |
 * +--------------+----------------------+----------------+-----------------+
 * | GET          | /project         | index          | project.index       |
 * | POST         | /project         | store          | project.store       |
 * | GET          | /project/{id}    | show           | project.show        |
 * | PUT          | /project/{id}    | update         | project.update      |
 * | DELETE       | /project/{id}    | destroy        | project.destroy     |
 * +--------------+----------------------+----------------+-----------------+
 * 
 * @controller \App\Http\Controllers\API\Project\ProjectController
 */

Route::apiResource('project', "Project\ProjectController");
