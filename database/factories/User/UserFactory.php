<?php

/** @var Factory $factory */

use App\Models\User\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        User::COLUMN_FIRST_NAME        => $faker->unique()->firstName,
        User::COLUMN_MIDDLE_NAME       => $faker->unique()->name,
        User::COLUMN_LAST_NAME         => $faker->unique()->lastName,  
        User::COLUMN_PHONE             => (string) Str::of($faker->e164PhoneNumber)->trim("+"),
        User::COLUMN_EMAIL             => $faker->unique()->safeEmail,
        User::COLUMN_EMAIL_VERIFIED_AT => now(),
        User::COLUMN_PASSWORD          => bcrypt('password'), // password /* $2y$10$KT6TwnptPtUjGMDVO4E9we64eGYYCaH/fupHvebv4OoFZMqAqH9wC */
        User::COLUMN_REMEMBER_TOKEN    => Str::random(10),
        User::COLUMN_IMAGE_ID          => null,
        User::COLUMN_ROLE_ID           => null,
        User::COLUMN_STATUS_ID         => null,
    ];
});
