<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Portfolio\Portfolio;
use App\Models\Status\Common\ActiveStatus;

$factory->define(Portfolio::class, function (Faker $faker) {
    return [
        Portfolio::COLUMN_NAME       => $faker->name,
        Portfolio::COLUMN_SLUG       => Str::slug($faker->name, '-'),
        Portfolio::COLUMN_TOTAL_AREA => rand(40, 120),
        Portfolio::COLUMN_DURATION   => rand(40, 120),
        Portfolio::COLUMN_BUDGET     => rand(10*10000, 99*10000),
        Portfolio::COLUMN_STATUS_ID  => ActiveStatus::first(),
    ];
});
