<?php

/** @var Factory $factory */

use App\Models\User\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/**
 * ===================================================================================================================
 * User person states
 * 
 * @states
 *    - Hondor
 *    - Maks
 *    - Yura
 *    - Obama
 *    - Moris
 *    - Pudge
 *    - Divora
 *    - Huskar
 *    - Sven
 *    - Lina
 */

$factory->state(User::class, 'Hondor', [
    User::COLUMN_FIRST_NAME     => 'Andrey',
    User::COLUMN_LAST_NAME      => 'Hondor',
    User::COLUMN_PHONE          => '380950700693',
    User::COLUMN_EMAIL          => 'wotshef@gmail.com',
]);

$factory->state(User::class, 'Maks', [
    User::COLUMN_FIRST_NAME     => 'Maxim',
    User::COLUMN_LAST_NAME      => 'Smirnov',
    User::COLUMN_PHONE          => '380957688813',
    User::COLUMN_EMAIL          => 'maks@zrobleno.com.ua',
]);

$factory->state(User::class, 'Yura', [
    User::COLUMN_FIRST_NAME     => 'Yura',
    User::COLUMN_LAST_NAME      => 'Marushchak',
    User::COLUMN_PHONE          => '380989912020',
    User::COLUMN_EMAIL          => 'yurikkiss1432@gmail.com',
]);

$factory->state(User::class, 'Obama', [
    User::COLUMN_FIRST_NAME     => 'Obama',
    User::COLUMN_LAST_NAME      => 'Barack',
    // User::COLUMN_PHONE          => '380' . '50' . rand(7, 7),
    User::COLUMN_EMAIL          => 'barack_obama@zrobleno.com.ua',
]);

$factory->state(User::class, 'Moris', [
    User::COLUMN_FIRST_NAME     => 'Moris',
    User::COLUMN_LAST_NAME      => 'Rozallo',
    // User::COLUMN_PHONE          => '380' . '50' . rand(7, 7),
    User::COLUMN_EMAIL          => 'moris_rozallo@zrobleno.com.ua',
]);

$factory->state(User::class, 'Pudge', [
    User::COLUMN_FIRST_NAME     => 'Pudge',
    User::COLUMN_PHONE          => '380500000001',
    User::COLUMN_EMAIL          => 'pudge@zrobleno.com.ua',
]);

$factory->state(User::class, 'Divora', [
    User::COLUMN_FIRST_NAME     => 'Divora',
    User::COLUMN_EMAIL          => 'divora@zrobleno.com.ua',
]);

$factory->state(User::class, 'Huskar', [
    User::COLUMN_FIRST_NAME     => 'Huskar',
    User::COLUMN_EMAIL          => 'huskar@zrobleno.com.ua',
]);

$factory->state(User::class, 'Sven', [
    User::COLUMN_FIRST_NAME     => 'Sven',
    User::COLUMN_EMAIL          => 'sven@zrobleno.com.ua',
]);

$factory->state(User::class, 'Lina', [
    User::COLUMN_FIRST_NAME     => 'Lina',
    User::COLUMN_EMAIL          => 'lina@zrobleno.com.ua',
]);

$factory->state(User::class, 'wotshef', [
    User::COLUMN_FIRST_NAME     => 'Andrey',
    User::COLUMN_LAST_NAME      => 'Hondor',
    User::COLUMN_PHONE          => '380950700693',
    User::COLUMN_EMAIL          => 'wotshef@gmail.com',
]);

$factory->state(User::class, 'owner_1', [
    User::COLUMN_FIRST_NAME     => 'Artem',
    User::COLUMN_LAST_NAME      => '',
    User::COLUMN_PHONE          => '0993800385',
    User::COLUMN_EMAIL          => 'artem@test.zrobleno.com.ua',
]);

$factory->state(User::class, 'owner_2', [
    User::COLUMN_FIRST_NAME     => 'Roman',
    User::COLUMN_LAST_NAME      => '',
    User::COLUMN_EMAIL          => 'roman@test.zrobleno.com.ua',
]);

$factory->state(User::class, 'owner_3', [
    User::COLUMN_FIRST_NAME     => 'Romeo',
    User::COLUMN_LAST_NAME      => 'Yats',
    User::COLUMN_PHONE          => '0963000143',
    User::COLUMN_EMAIL          => 'romeo.yats@gmail.com',
]);
