<?php

/** @var Factory $factory */

use App\Models\Status\Common\ActiveStatus;
use Faker\Generator as Faker;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Category::class, function (Faker $faker) {
    return [
        Category::COLUMN_SLUG           => $faker->slug,
        Category::COLUMN_NAME           => $faker->sentence(),
        Category::COLUMN_DESCRIPTION    => $faker->paragraph,
        Category::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->state(Category::class, 'test', [
    Category::COLUMN_USER_ID    => 4,
]);
