<?php

/** @var Factory $factory */

use App\Models\PostType\PostType;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(PostType::class, function (Faker $faker) {
    return [
        PostType::COLUMN_SLUG           => $faker->slug,
        PostType::COLUMN_NAME           => $faker->name,
        PostType::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->state(PostType::class, 'post', [
    PostType::COLUMN_SLUG           => 'post',
    PostType::COLUMN_NAME           => "Публікація",
]);

$factory->state(PostType::class, 'page', [
    PostType::COLUMN_SLUG           => 'page',
    PostType::COLUMN_NAME           => "Сторінка",
]);

$factory->state(PostType::class, 'widget', [
    PostType::COLUMN_SLUG           => 'widget',
    PostType::COLUMN_NAME           => "Віджет",
]);

$factory->state(PostType::class, 'form', [
    PostType::COLUMN_SLUG           => 'form',
    PostType::COLUMN_NAME           => "Форма",
]);

$factory->state(PostType::class, 'menu', [
    PostType::COLUMN_SLUG           => 'menu',
    PostType::COLUMN_NAME           => "Меню",
]);

$factory->state(PostType::class, 'portfolio', [
    PostType::COLUMN_SLUG           => 'portfolio',
    PostType::COLUMN_NAME           => "Портфоліо",
]);