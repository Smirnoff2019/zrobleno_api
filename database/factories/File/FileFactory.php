<?php

/** @var Factory $factory */

use App\Models\File\File;
use App\Models\User\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\Common\ActiveStatus;


$factory->define(File::class, function (Faker $faker) {
    $format = 'jpeg';
    $fileName = Str::random(10) . "_" . time() . ".$format";
    $user_id = User::inRandomOrder()->first()->id;
    return [
        File::COLUMN_NAME          => $fileName,
        File::COLUMN_PATH          => "storage/app/public/users/$user_id/$fileName",
        File::COLUMN_URL           => env("APP-URL")."/storage/users/$user_id/$fileName",
        File::COLUMN_URI           => "storage/app/public/users/$user_id",
        File::COLUMN_FORMAT        => $format,
        File::COLUMN_SIZE          => rand(10000, 100000),
        File::COLUMN_TITLE         => $fileName,
        File::COLUMN_DESCRIPTION   => $faker->paragraph,
        File::COLUMN_SORT          => null,
        File::COLUMN_STATUS_ID     => ActiveStatus::first(),
        File::COLUMN_USER_ID       => $user_id,
    ];
});

$factory->state(File::class, 'png', function(Faker $faker) {
    $format = 'png';
    $fileName = Str::random(10) . "_" . time() . ".$format";
    $user_id = User::inRandomOrder()->first()->id;
    return [
        File::COLUMN_NAME          => $fileName,
        File::COLUMN_PATH          => "storage/app/public/users/$user_id/$fileName",
        File::COLUMN_URL           => env("APP-URL")."/storage/users/$user_id/$fileName",
        File::COLUMN_URI           => "storage/app/public/users/$user_id",
        File::COLUMN_FORMAT        => $format,
    ];
});

$factory->state(File::class, 'pdf', function(Faker $faker) {
    $format = 'pdf';
    $fileName = Str::random(10) . "_" . time() . ".$format";
    $user_id = User::inRandomOrder()->first()->id;
    return [
        File::COLUMN_NAME          => $fileName,
        File::COLUMN_PATH          => "storage/app/public/users/$user_id/$fileName",
        File::COLUMN_URL           => env("APP-URL")."/storage/users/$user_id/$fileName",
        File::COLUMN_URI           => "storage/app/public/users/$user_id",
        File::COLUMN_FORMAT        => $format,
    ];
});

$factory->state(File::class, 'docx', function(Faker $faker) {
    $format = 'docx';
    $fileName = Str::random(10) . "_" . time() . ".$format";
    $user_id = User::inRandomOrder()->first()->id;
    return [
        File::COLUMN_NAME          => $fileName,
        File::COLUMN_PATH          => "storage/app/public/users/$user_id/$fileName",
        File::COLUMN_URL           => env("APP-URL")."/storage/users/$user_id/$fileName",
        File::COLUMN_URI           => "storage/app/public/users/$user_id",
        File::COLUMN_FORMAT        => $format,
    ];
});

$factory->state(File::class, 'txt', function(Faker $faker) {
    $format = 'txt';
    $fileName = Str::random(10) . "_" . time() . ".$format";
    $user_id = User::inRandomOrder()->first()->id;
    return [
        File::COLUMN_NAME          => $fileName,
        File::COLUMN_PATH          => "storage/app/public/users/$user_id/$fileName",
        File::COLUMN_URL           => env("APP-URL")."/storage/users/$user_id/$fileName",
        File::COLUMN_URI           => "storage/app/public/users/$user_id",
        File::COLUMN_FORMAT        => $format,
    ];
});

