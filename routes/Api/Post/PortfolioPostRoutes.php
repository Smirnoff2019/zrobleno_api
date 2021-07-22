<?php

use Illuminate\Support\Facades\Route;

/** 
 * --------------------------------------------------------------------------
 * PortfolioPost API Routes
 * --------------------------------------------------------------------------
 */

/** 
 * PortfolioPost api resource routes
 * 
 * +--------------+--------------------------+----------------+-------------------+
 * | Method       | URI                      | Action         | Route Name        |
 * +--------------+--------------------------+----------------+-------------------+
 * | GET          | /portfolio               | index          | portfolio.index   |
 * | POST         | /portfolio               | store          | portfolio.store   |
 * | GET          | /portfolio/{portfolio_id}| show           | portfolio.show    |
 * +--------------+--------------------------+----------------+-------------------+
 * 
 * @controller Post\PortfolioApiController
 */

Route::apiResource('portfolio', 'Post\PortfolioApiController')
    ->only([
    'index',
    'store',
    'show'
]);
