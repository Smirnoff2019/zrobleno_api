<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Role\CustomerRole;
use App\Models\Role\ContractorRole;
use App\Models\Status\Common\ActiveStatus;
use App\Models\SupplierDiscount\SupplierDiscount;
use App\Models\SupplierDiscount\CustomerSupplierDiscount;
use App\Models\SupplierDiscount\ContractorSupplierDiscount;

$factory->define(SupplierDiscount::class, function (Faker $faker) {
    return [
        SupplierDiscount::COLUMN_VALUE      => 20,
        SupplierDiscount::COLUMN_STATUS_ID  => ActiveStatus::first(),
    ];
});

$factory->define(ContractorSupplierDiscount::class, function (Faker $faker) {
    return [
        SupplierDiscount::COLUMN_VALUE      => 15,
        SupplierDiscount::COLUMN_STATUS_ID  => ActiveStatus::first(),
        SupplierDiscount::COLUMN_ROLE_ID    => ContractorRole::first(),
    ];
});

$factory->define(CustomerSupplierDiscount::class, function (Faker $faker) {
    return [
        SupplierDiscount::COLUMN_VALUE      => 20,
        SupplierDiscount::COLUMN_STATUS_ID  => ActiveStatus::first(),
        SupplierDiscount::COLUMN_ROLE_ID    => CustomerRole::first(),
    ];
});

/**
 * ===================================================================================================================
 */

$factory->state(SupplierDiscount::class, ContractorSupplierDiscount::class, [
    SupplierDiscount::COLUMN_VALUE      => 15,
    SupplierDiscount::COLUMN_ROLE_ID    => ContractorRole::first(),
]);

$factory->state(SupplierDiscount::class, CustomerSupplierDiscount::class, [
    SupplierDiscount::COLUMN_VALUE      => 20,
    SupplierDiscount::COLUMN_ROLE_ID    => CustomerRole::first(),
]);

/**
 * ===================================================================================================================
 */
