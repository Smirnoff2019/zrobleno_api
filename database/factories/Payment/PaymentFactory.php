<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\Models\Payment\Payment;

$paymentTypes = [
    "replenishment",    // пополнение
    "write-off",        // списание
    "refunds",          // возврат средств
];

$factory->define(Payment::class, function (Faker $faker) use($paymentTypes) {
    return [
        Payment::COLUMN_VALUE       => rand(200, 1000),
        Payment::COLUMN_BALANCE     => rand(2000, 6000),
        Payment::COLUMN_TYPE        => Arr::random($paymentTypes),
        Payment::COLUMN_ACCOUNT_ID  => null,
        Payment::COLUMN_STATUS_ID   => null,
    ];
});
