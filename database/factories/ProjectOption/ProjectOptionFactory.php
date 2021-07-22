<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\ProjectOption\ProjectOption;

$factory->define(ProjectOption::class, function (Faker $faker) {
    return [
        ProjectOption::COLUMN_COUNT => null,
    ];
});
