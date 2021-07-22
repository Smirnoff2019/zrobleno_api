<?php

/** @var Factory $factory */

use App\Models\Meta\Meta;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

/**
 * Meta base factory
 **/
$factory->define(Meta::class, function (Faker $faker) {
    return [
        Meta::COLUMN_SLUG          => $faker->slug,
        Meta::COLUMN_NAME          => $faker->name,
        Meta::COLUMN_DESCRIPTION   => $faker->paragraph,
        Meta::COLUMN_PARENT_ID     => null,
        Meta::COLUMN_META_FIELD_ID => null
    ];
});

$factory->state(Meta::class, 'input_text', [
    Meta::COLUMN_META_FIELD_ID   => 1,
]);
