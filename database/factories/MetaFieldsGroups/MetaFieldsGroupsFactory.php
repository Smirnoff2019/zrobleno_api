<?php

/** @var Factory $factory */

use App\Models\MetaFieldsGroups\MetaFieldsGroups;
use App\Models\Status\Common\ActiveStatus;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

/**
 * MetaFields base factory
 **/
$factory->define(MetaFieldsGroups::class, function (Faker $faker) {
    return [
        MetaFieldsGroups::COLUMN_NAME      => $faker->name,
        MetaFieldsGroups::COLUMN_STATUS_ID => ActiveStatus::first(),
    ];
});

$factory->state(MetaFieldsGroups::class, 'posts', [
    MetaFieldsGroups::COLUMN_NAME      => "posts"
]);

$factory->state(MetaFieldsGroups::class, 'categories', [
    MetaFieldsGroups::COLUMN_NAME      => "categories"
]);

$factory->state(MetaFieldsGroups::class, 'postTypes', [
    MetaFieldsGroups::COLUMN_NAME      => "postTypes"
]);
