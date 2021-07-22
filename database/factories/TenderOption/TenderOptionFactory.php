<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\Models\TenderOption\TenderOption;

$factory->define(TenderOption::class, function (Faker $faker) {

    $name = Arr::random([
        'Ремонт смарт-квартири',
        'Ремонт 1-о кімнатної квартири',
        'Ремонт 2-ох кімнатної квартири',
        'Ремонт 3-ох кімнатної квартири',
    ]);
    $max_participants = rand(4, 11);
    $price = rand(420, 2000);

    return [
        TenderOption::COLUMN_NAME               => $name,
        TenderOption::COLUMN_MAX_PARTICIPANTS   => $max_participants,
        TenderOption::COLUMN_PRICE              => $price,
        TenderOption::COLUMN_PROJECT_ID         => null,
    ];
});

$factory->state(TenderOption::class, "smart", function (Faker $faker) {
    return [
        TenderOption::COLUMN_NAME => 'Ремонт смарт-квартири',
    ];
});

$factory->state(TenderOption::class, "1-room", function (Faker $faker) {
    return [
        TenderOption::COLUMN_NAME => 'Ремонт 1-о кімнатної квартири',
    ];
});

$factory->state(TenderOption::class, "2-room", function (Faker $faker) {
    return [
        TenderOption::COLUMN_NAME => 'Ремонт 2-ох кімнатної квартири',
    ];
});

$factory->state(TenderOption::class, "3-room", function (Faker $faker) {
    return [
        TenderOption::COLUMN_NAME => 'Ремонт 3-ох кімнатної квартири',
    ];
});
