<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use App\Models\AccountType\AccountType;
use Illuminate\Database\Eloquent\Factory;

$factory->define(AccountType::class, function (Faker $faker) {
    return [
        AccountType::COLUMN_SLUG => $faker->slug,
        AccountType::COLUMN_NAME => $faker->name,
        AccountType::COLUMN_DESCRIPTION => $faker->realText(),
    ];
});


$factory->state(AccountType::class, "main", [
    AccountType::COLUMN_SLUG => 'main',
    AccountType::COLUMN_NAME => 'Основной'
]);

$factory->state(AccountType::class, "bonus", [
    AccountType::COLUMN_SLUG => 'bonus',
    AccountType::COLUMN_NAME => 'Бонусный'
]);
