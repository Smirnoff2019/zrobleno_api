<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Complaint\Complaint;
use App\Models\Status\Complaint\InProcessingStatus;

$factory->define(Complaint::class, function (Faker $faker) {
    return [
        Complaint::COLUMN_SUBJECT   => $faker->sentence(rand(2, 10)),
        Complaint::COLUMN_MESSAGE   => $faker->text,
        Complaint::COLUMN_STATUS_ID => InProcessingStatus::first(),
    ];
});
