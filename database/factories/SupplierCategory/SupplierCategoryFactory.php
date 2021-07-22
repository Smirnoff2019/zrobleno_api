<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Status\Common\ActiveStatus;
use App\Models\SupplierCategory\SupplierCategory;

$factory->define(SupplierCategory::class, function (Faker $faker) {
    return [
        SupplierCategory::COLUMN_NAME => $name = $faker->word(),
        SupplierCategory::COLUMN_SLUG => Str::slug($name),
        SupplierCategory::COLUMN_STATUS_ID => ActiveStatus::first(),
    ];
});
