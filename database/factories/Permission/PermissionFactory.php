<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Permission\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        Permission::COLUMN_NAME => '',
        Permission::COLUMN_SLUG => '',
        Permission::COLUMN_DESCRIPTION => $faker->realText(),
        Permission::COLUMN_MODULE_NAME => '',
        Permission::COLUMN_METHOD_NAME => null,
        Permission::COLUMN_PARENT_ID => null,
        Permission::COLUMN_POSITION => 1,
        Permission::COLUMN_IS_ACTIVE => 1,
    ];
});
