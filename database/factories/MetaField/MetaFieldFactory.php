<?php

/** @var Factory $factory */

use App\Models\MetaField\CheckboxField;
use App\Models\MetaField\CKEditorField;
use App\Models\MetaField\EmailField;
use App\Models\MetaField\GroupField;
use App\Models\MetaField\ImageField;
use App\Models\MetaField\ImagesGalleryField;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;
use App\Models\MetaField\MetaField;
use App\Models\MetaField\MetaFieldsGroup;
use App\Models\MetaField\NumberField;
use App\Models\MetaField\RadioButtonField;
use App\Models\MetaField\SelectField;
use App\Models\MetaField\TextareaField;
use App\Models\MetaField\TextField;
use App\Models\MetaField\UrlField;

/**
 * MetaFields base factory
 **/
$factory->define(MetaField::class, function (Faker $faker) {
    return [
        MetaField::COLUMN_SLUG        => $faker->slug,
        MetaField::COLUMN_NAME        => $faker->name,
        MetaField::COLUMN_DESCRIPTION => $faker->paragraph,
        MetaField::COLUMN_OPTIONS     => null,
    ];
});

$factory->define(MetaFieldsGroup::class, function (Faker $faker) {
    return [
        MetaField::COLUMN_SLUG        => MetaFieldsGroup::DEFAULT_SLUG,
        MetaField::COLUMN_NAME        => MetaFieldsGroup::DEFAULT_NAME,
    ];
});

$factory->state(MetaField::class, MetaFieldsGroup::class, [
    MetaField::COLUMN_SLUG => MetaFieldsGroup::DEFAULT_SLUG,
    MetaField::COLUMN_NAME => MetaFieldsGroup::DEFAULT_NAME,
]);

/**
 * Meta field types factories by personal model
 */

$factory->define(TextField::class, function (Faker $faker) {
    return [
        TextField::COLUMN_SLUG => TextField::DEFAULT_SLUG,
        TextField::COLUMN_NAME => TextField::DEFAULT_NAME,
    ];
});

$factory->define(TextareaField::class, function (Faker $faker) {
    return [
        TextareaField::COLUMN_SLUG => TextareaField::DEFAULT_SLUG,
        TextareaField::COLUMN_NAME => TextareaField::DEFAULT_NAME,
    ];
});

$factory->define(NumberField::class, function (Faker $faker) {
    return [
        NumberField::COLUMN_SLUG => NumberField::DEFAULT_SLUG,
        NumberField::COLUMN_NAME => NumberField::DEFAULT_NAME,
    ];
});

$factory->define(EmailField::class, function (Faker $faker) {
    return [
        EmailField::COLUMN_SLUG => EmailField::DEFAULT_SLUG,
        EmailField::COLUMN_NAME => EmailField::DEFAULT_NAME,
    ];
});

$factory->define(UrlField::class, function (Faker $faker) {
    return [
        UrlField::COLUMN_SLUG => UrlField::DEFAULT_SLUG,
        UrlField::COLUMN_NAME => UrlField::DEFAULT_NAME,
    ];
});

$factory->define(ImageField::class, function (Faker $faker) {
    return [
        ImageField::COLUMN_SLUG => ImageField::DEFAULT_SLUG,
        ImageField::COLUMN_NAME => ImageField::DEFAULT_NAME,
    ];
});

$factory->define(ImagesGalleryField::class, function (Faker $faker) {
    return [
        ImagesGalleryField::COLUMN_SLUG => ImagesGalleryField::DEFAULT_SLUG,
        ImagesGalleryField::COLUMN_NAME => ImagesGalleryField::DEFAULT_NAME,
    ];
});

$factory->define(CKEditorField::class, function (Faker $faker) {
    return [
        CKEditorField::COLUMN_SLUG => CKEditorField::DEFAULT_SLUG,
        CKEditorField::COLUMN_NAME => CKEditorField::DEFAULT_NAME,
    ];
});

$factory->define(SelectField::class, function (Faker $faker) {
    return [
        SelectField::COLUMN_SLUG => SelectField::DEFAULT_SLUG,
        SelectField::COLUMN_NAME => SelectField::DEFAULT_NAME,
    ];
});

$factory->define(CheckboxField::class, function (Faker $faker) {
    return [
        CheckboxField::COLUMN_SLUG => CheckboxField::DEFAULT_SLUG,
        CheckboxField::COLUMN_NAME => CheckboxField::DEFAULT_NAME,
    ];
});

$factory->define(RadioButtonField::class, function (Faker $faker) {
    return [
        RadioButtonField::COLUMN_SLUG => RadioButtonField::DEFAULT_SLUG,
        RadioButtonField::COLUMN_NAME => RadioButtonField::DEFAULT_NAME,
    ];
});

$factory->define(GroupField::class, function (Faker $faker) {
    return [
        GroupField::COLUMN_SLUG => GroupField::DEFAULT_SLUG,
        GroupField::COLUMN_NAME => GroupField::DEFAULT_NAME,
    ];
});