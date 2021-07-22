<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Status\Common\ActiveStatus;
use App\Models\Supplier\Supplier;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        Supplier::COLUMN_NAME => $faker->company,
        Supplier::COLUMN_DESCRIPTION => $faker->companySuffix .": \"". $faker->jobTitle,
        Supplier::COLUMN_CATALOG_URL => '',
        Supplier::COLUMN_IMAGE_ID => null,
        Supplier::COLUMN_STATUS_ID => ActiveStatus::first(),
    ];
});
