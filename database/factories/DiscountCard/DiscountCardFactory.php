<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DiscountCard\DiscountCard;
use App\Models\Status\Common\ActiveStatus;
use Faker\Generator as Faker;

$factory->define(DiscountCard::class, function (Faker $faker) {
    return [
        DiscountCard::COLUMN_CARD_NUMBER  => rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999),
        DiscountCard::COLUMN_STATUS_ID    => ActiveStatus::first(),
        DiscountCard::COLUMN_EXPIRATED_AT => now()->addMonths(3),
    ];
});
