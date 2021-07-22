<?php

/** @var Factory $factory */

use App\Models\Image\Image;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\Common\ActiveStatus;

$factory->define(Image::class, function (Faker $faker) {
    return [
        Image::COLUMN_FILE_ID    => null,
        Image::COLUMN_PARENT_ID  => null,
        Image::COLUMN_STATUS_ID  => ActiveStatus::first(),
    ];
});

