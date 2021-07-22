<?php

/** @var Factory $factory */

use App\Models\Status\Common\ActiveStatus;
use App\Models\Taxonomy\BlogCategoryTaxonomy;
use App\Models\Taxonomy\PortfolioCategoryTaxonomy;
use App\Models\Taxonomy\Taxonomy;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Taxonomy::class, function (Faker $faker) {
    return [
        Taxonomy::COLUMN_SLUG           => $faker->slug,
        Taxonomy::COLUMN_NAME           => $faker->name,
        Taxonomy::COLUMN_DESCRIPTION    => $faker->paragraph,
        Taxonomy::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->state(Taxonomy::class, PortfolioCategoryTaxonomy::class, function (Faker $faker) {
    return [
        Taxonomy::COLUMN_NAME  => PortfolioCategoryTaxonomy::DEFAULT_NAME,
        Taxonomy::COLUMN_SLUG  => PortfolioCategoryTaxonomy::DEFAULT_SLUG,
    ];
});


$factory->define(PortfolioCategoryTaxonomy::class, function (Faker $faker) {
    return [
        Taxonomy::COLUMN_NAME           => PortfolioCategoryTaxonomy::DEFAULT_NAME,
        Taxonomy::COLUMN_SLUG           => PortfolioCategoryTaxonomy::DEFAULT_SLUG,
        Taxonomy::COLUMN_DESCRIPTION    => $faker->paragraph,
        Taxonomy::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});

$factory->state(Taxonomy::class, BlogCategoryTaxonomy::class, function (Faker $faker) {
    return [
        Taxonomy::COLUMN_NAME  => BlogCategoryTaxonomy::DEFAULT_NAME,
        Taxonomy::COLUMN_SLUG  => BlogCategoryTaxonomy::DEFAULT_SLUG,
    ];
});

$factory->define(BlogCategoryTaxonomy::class, function (Faker $faker) {
    return [
        Taxonomy::COLUMN_NAME           => BlogCategoryTaxonomy::DEFAULT_NAME,
        Taxonomy::COLUMN_SLUG           => BlogCategoryTaxonomy::DEFAULT_SLUG,
        Taxonomy::COLUMN_DESCRIPTION    => $faker->paragraph,
        Taxonomy::COLUMN_STATUS_ID      => ActiveStatus::first(),
    ];
});
