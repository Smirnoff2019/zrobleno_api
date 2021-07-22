<?php

namespace App\Services\Blade;

use App\Models\MetaField\CheckboxField;
use App\Models\MetaField\CKEditorField;
use App\Models\MetaField\EmailField;
use App\Models\MetaField\GroupField;
use App\Models\MetaField\ImageField;
use App\Models\MetaField\ImagesGalleryField;
use App\Models\MetaField\MetaField;
use App\Models\MetaField\NumberField;
use App\Models\MetaField\PasswordField;
use App\Models\MetaField\RadioButtonField;
use App\Models\MetaField\SelectField;
use App\Models\MetaField\TextareaField;
use App\Models\MetaField\TextField;
use App\Models\MetaField\UrlField;
use App\Models\Meta\Meta;
use App\Models\Room\Room;
use Illuminate\Support\Str;

// use Illuminate\View\ComponentAttributeBag;

class MetaFieldsService
{
    /**
     * The meta fields types
     *
     * @var array|collect(:array)
     */
    public $metaFieldsTypes = [];

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->metaFieldsTypes = collect([
            TextField::make(),
            TextareaField::make(),
            NumberField::make(),
            EmailField::make(),
            UrlField::make(),
            PasswordField::make(),
            ImageField::make(),
            ImagesGalleryField::make(),
            CKEditorField::make(),
            SelectField::make(),
            CheckboxField::make(),
            RadioButtonField::make(),
            GroupField::make(),
        ])->keyBy(MetaField::COLUMN_SLUG);
    }

    /**
     * Get meta field name by slug
     *
     * @param string $slug
     * @return string
     */
    public function getName(string $slug)
    {
        return $this->get($slug)->name ?? null;
    }

    /**
     * Get meta field data by slug
     *
     * @param string $slug
     * @param mixed|null $default
     * @return \App\Models\MetaField\MetaField
     */
    public function get(string $slug, $default = null)
    {
        return $this->metaFieldsTypes
            ->where(
                MetaField::COLUMN_SLUG,
                $slug
            )
            ->first() ?? $default;
    }

    /**
     * Get calculator rooms list
     *
     * @param array $field
     * @return \App\Models\MetaField\MetaField
     */
    public static function createNewMeta($field)
    {
        if (static::isMethodExists($methodName = static::makeMetaCreateMethodName($field['type'] ?? ''))) {
            return static::{$methodName}($field);
        }

        return static::createMetaWithFieldType($field, $field['type'] ?? 'text');
    }

    /**
     * Get calculator rooms list
     *
     * @param array $field
     * @return \App\Models\MetaField\MetaField
     */
    public static function updateOrCreateMeta($field)
    {
        // dd($field);

        if (static::isMethodExists($methodName = static::makeMetaUpdateOrCreateMethodName($field['type'] ?? ''))) {
            return static::{$methodName}($field);
        }

        return static::updateOrCreateMetaWithFieldType($field, $field['type'] ?? 'text');
    }

    /**
     * Create new meta with text
     *
     * @param  Meta   $meta
     * @param  string $type
     * @return Meta
     */
    public static function associateMetaWithFieldType(Meta $meta, string $type)
    {
        $metaField = (new static)->get($type);

        $meta->metaField()->associate(
            $metaField = MetaField::whereSlug($type)->firstOr(function () use ($metaField) {
                return $metaField->create();
            })
        );

        return $meta;
    }

    /**
     * Create new meta with type text
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaWithFieldType(array $field, string $type)
    {
        $data = collect($field);

        $meta = Meta::make($data->only(['name', 'slug', 'description', 'options']));
        $meta = static::associateMetaWithFieldType($meta, $type);
        $meta->save();

        return $meta;
    }

    /**
     * Update or create meta with type text
     *
     * @param  array  $field
     * @return mixed
     */
    public static function updateOrCreateMetaWithFieldType(array $field, string $type)
    {
        $data = collect($field);

        $data->put('options', $data->only(['options']));
        $meta = Meta::updateOrCreate(
            $data->only(['id'])->toArray(),
            $data->only(['name', 'slug', 'description', 'options'])->toArray()
        );
        $meta = static::associateMetaWithFieldType($meta, $type);
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type text
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaText(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Update meta with type text
     *
     * @param  array  $field
     * @return mixed
     */
    public static function updateMetaText(array $field)
    {
        $data = collect($field);

        $data->put('options', $data->only(['options']));
        $meta = Meta::updateOrCreate(
            $data->only(['id'])->toArray(),
            $data->only(['name', 'slug', 'description', 'options'])->toArray()
        );
        $meta = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type textarea
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaTextarea(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type number
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaNumber(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type email
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaEmail(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type url
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaUrl(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type password
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaPassword(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type image
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaImage(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type images gallery
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaImagesGallery(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type select
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaSelect(array $field)
    {
        $data = collect($field);

        $meta = Meta::make($data->only(['name', 'slug', 'description'])->toArray());

        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Update meta with type select
     *
     * @param  array  $field
     * @return mixed
     */
    public static function updateOrCreateMetaSelect(array $field)
    {
        $data = collect($field);

        $opt = json_decode($data->get('options', "{}"));

        $data->put('options', $opt);
        $meta = Meta::updateOrCreate(
            $data->only(['id'])->toArray(),
            $data->only(['name', 'slug', 'description', 'options'])->toArray()
        );
        $meta = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Create new meta with type group
     *
     * @param  array  $field
     * @return mixed
     */
    public static function createMetaGroup(array $field)
    {
        $data = collect($field);

        $meta          = Meta::make($data->only(['name', 'slug', 'description'])->toArray());
        $meta->options = $data->only(['options']) ?? [];
        $meta          = static::associateMetaWithFieldType($meta, $data->get('type', ''));
        $meta->save();

        return $meta;
    }

    /**
     * Make method name by type
     *
     * @param  string  $type
     * @return bool
     */
    public static function makeMetaCreateMethodName(string $type)
    {
        return "createMeta" . (string) Str::of($type)->studly();
    }

    /**
     * Make method name by type
     *
     * @param  string  $type
     * @return bool
     */
    public static function makeMetaUpdateOrCreateMethodName(string $type)
    {
        return "updateOrCreateMeta" . (string) Str::of($type)->studly();
    }

    /**
     * Check class has method
     *
     * @param  string  $methodName
     * @return bool
     */
    public static function isMethodExists(string $methodName)
    {
        return (bool) method_exists((new static), $methodName);
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->metaFieldsTypes->get($key);
    }

    /**
     * Handle dynamic method calls into the service.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, ['get', 'getName'])) {
            return $this->$method(...$parameters);
        }
    }

    /**
     * Handle dynamic static method calls into the service.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
