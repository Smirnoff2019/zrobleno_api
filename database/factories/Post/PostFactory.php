<?php

/** @var Factory $factory */

use App\Models\Post\BlogPost;
use App\Models\Post\FormPost;
use App\Models\Post\MenuPost;
use App\Models\Post\PagePost;
use App\Models\Post\PortfolioPost;
use App\Models\Post\Post;
use App\Models\Post\WidgetPost;
use App\Models\Status\Common\ActiveStatus;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Post::class, function (Faker $faker) {
    return [
        Post::COLUMN_SLUG           => $faker->slug,
        Post::COLUMN_TITLE          => $faker->title,
        Post::COLUMN_DESCRIPTION    => $faker->paragraph,
        Post::COLUMN_CONTENT        => $faker->paragraph,
        Post::COLUMN_POST_TYPE      => null,
        Post::COLUMN_PARENT_ID      => null,
        Post::COLUMN_USER_ID        => null,
        Post::COLUMN_IMAGE_ID       => null,
        Post::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->define(BlogPost::class, function (Faker $faker) {
    return [
        BlogPost::COLUMN_SLUG           => $faker->slug,
        BlogPost::COLUMN_TITLE          => $faker->title,
        BlogPost::COLUMN_DESCRIPTION    => $faker->paragraph,
        BlogPost::COLUMN_CONTENT        => $faker->paragraph,
        BlogPost::COLUMN_POST_TYPE      => BlogPost::DEFAULT_POST_TYPE,
        BlogPost::COLUMN_PARENT_ID      => null,
        BlogPost::COLUMN_USER_ID        => null,
        BlogPost::COLUMN_IMAGE_ID       => null,
        BlogPost::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->define(WidgetPost::class, function (Faker $faker) {
    return [
        WidgetPost::COLUMN_SLUG           => $faker->slug,
        WidgetPost::COLUMN_TITLE          => $faker->title,
        WidgetPost::COLUMN_DESCRIPTION    => $faker->paragraph,
        WidgetPost::COLUMN_CONTENT        => $faker->paragraph,
        WidgetPost::COLUMN_POST_TYPE      => WidgetPost::DEFAULT_POST_TYPE,
        WidgetPost::COLUMN_PARENT_ID      => null,
        WidgetPost::COLUMN_USER_ID        => null,
        WidgetPost::COLUMN_IMAGE_ID       => null,
        WidgetPost::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->define(PortfolioPost::class, function (Faker $faker) {
    return [
        PortfolioPost::COLUMN_SLUG           => $faker->slug,
        PortfolioPost::COLUMN_TITLE          => $faker->title,
        PortfolioPost::COLUMN_DESCRIPTION    => $faker->paragraph,
        PortfolioPost::COLUMN_CONTENT        => $faker->paragraph,
        PortfolioPost::COLUMN_POST_TYPE      => PortfolioPost::DEFAULT_POST_TYPE,
        PortfolioPost::COLUMN_PARENT_ID      => null,
        PortfolioPost::COLUMN_USER_ID        => null,
        PortfolioPost::COLUMN_IMAGE_ID       => null,
        PortfolioPost::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->define(PagePost::class, function (Faker $faker) {
    return [
        PagePost::COLUMN_SLUG           => $faker->slug,
        PagePost::COLUMN_TITLE          => $faker->title,
        PagePost::COLUMN_DESCRIPTION    => $faker->paragraph,
        PagePost::COLUMN_CONTENT        => $faker->paragraph,
        PagePost::COLUMN_POST_TYPE      => PagePost::DEFAULT_POST_TYPE,
        PagePost::COLUMN_PARENT_ID      => null,
        PagePost::COLUMN_USER_ID        => null,
        PagePost::COLUMN_IMAGE_ID       => null,
        PagePost::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->define(FormPost::class, function (Faker $faker) {
    return [
        FormPost::COLUMN_SLUG           => $faker->slug,
        FormPost::COLUMN_TITLE          => $faker->title,
        FormPost::COLUMN_DESCRIPTION    => $faker->paragraph,
        FormPost::COLUMN_CONTENT        => $faker->paragraph,
        FormPost::COLUMN_POST_TYPE      => FormPost::DEFAULT_POST_TYPE,
        FormPost::COLUMN_PARENT_ID      => null,
        FormPost::COLUMN_USER_ID        => null,
        FormPost::COLUMN_IMAGE_ID       => null,
        FormPost::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->define(MenuPost::class, function (Faker $faker) {
    return [
        MenuPost::COLUMN_SLUG           => $faker->slug,
        MenuPost::COLUMN_TITLE          => $faker->title,
        MenuPost::COLUMN_DESCRIPTION    => $faker->paragraph,
        MenuPost::COLUMN_CONTENT        => $faker->paragraph,
        MenuPost::COLUMN_POST_TYPE      => MenuPost::DEFAULT_POST_TYPE,
        MenuPost::COLUMN_PARENT_ID      => null,
        MenuPost::COLUMN_USER_ID        => null,
        MenuPost::COLUMN_IMAGE_ID       => null,
        MenuPost::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});
