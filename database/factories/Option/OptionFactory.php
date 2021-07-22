<?php

/** @var Factory $factory */

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;
use App\Models\Option\Option;
use Faker\Generator as Faker;
use App\Models\Status\Common\ActiveStatus;

$factory->define(Option::class, function (Faker $faker) {
    return [
        Option::COLUMN_NAME => $faker->name,
        Option::COLUMN_SLUG => Str::slug($faker->name),
        Option::COLUMN_IMAGE_ID => null,
        Option::COLUMN_ROOM_ID => null,
        Option::COLUMN_STATUS_ID => ActiveStatus::first()
    ];
});
