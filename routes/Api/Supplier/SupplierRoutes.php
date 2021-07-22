<?php

use Illuminate\Support\Facades\Route;

/**
 * --------------------------------------------------------------------------
 * Supplier API Routes
 * --------------------------------------------------------------------------
 */


/**
 * Supplier categories api resource routes
 *
 * +--------------+---------------------------------------+----------------+-------------------------------+
 * | Method       | URI                                   | Action         | Route Name                    |
 * +--------------+---------------------------------------+----------------+-------------------------------+
 * | GET          | /supplier/categories                  | index          | supplier.categories.index     |
 * | POST         | /supplier/categories                  | store          | supplier.categories.store     |
 * | GET          | /supplier/categories/{category_id}    | show           | supplier.categories.show      |
 * | PUT          | /supplier/categories/{category_id}    | update         | supplier.categories.update    |
 * | DELETE       | /supplier/categories/{category_id}    | destroy        | supplier.categories.destroy   |
 * +--------------+---------------------------------------+----------------+-------------------------------+
 *
 * @controller \App\Http\Controllers\API\SupplierCategory\SupplierCategoryApiController
 */

Route::apiResource('supplier/category', 'SupplierCategory\SupplierCategoryApiController')->names('suppliers.categories');


/**
 * Supplier api resource routes
 *
 * +--------------+------------------------------+----------------+----------------------+
 * | Method       | URI                          | Action         | Route Name           |
 * +--------------+------------------------------+----------------+----------------------+
 * | GET          | /supplier                    | index          | supplier.index       |
 * | POST         | /supplier                    | store          | supplier.store       |
 * | GET          | /supplier/{supplier_id}      | show           | supplier.show        |
 * | PUT          | /supplier/{supplier_id}      | update         | supplier.update      |
 * | DELETE       | /supplier/{supplier_id}      | destroy        | supplier.destroy     |
 * +--------------+------------------------------+----------------+----------------------+
 *
 * @controller \App\Http\Controllers\API\Supplier\SupplierApiController
 */

Route::apiResource('supplier', 'Supplier\SupplierApiController');
