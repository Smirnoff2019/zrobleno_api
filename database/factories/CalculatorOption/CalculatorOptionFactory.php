<?php

/** @var Factory $factory */

use App\Models\CalculatorOption\CalculatorOption;
use App\Models\CalculatorOption\Coefficient;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Status\Common\ActiveStatus;

$factory->define(CalculatorOption::class, function (Faker $faker) {
    return [
        CalculatorOption::COLUMN_TYPE           => null,
        CalculatorOption::COLUMN_VALUE          => null,
        CalculatorOption::COLUMN_SLUG           => Str::slug($faker->title),
        CalculatorOption::COLUMN_NAME           => $faker->title,
        CalculatorOption::COLUMN_DESCRIPTION    => $faker->paragraph,
        CalculatorOption::COLUMN_STATUS_ID      => ActiveStatus::first()
    ];
});

$factory->state(CalculatorOption::class, Coefficient::class, [
    CalculatorOption::COLUMN_TYPE => Coefficient::DEFAULT_TYPE,
]);