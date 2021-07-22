<?php


namespace App\Models\Role;

use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Builder;

class UserRole extends Role
{

    /**
     * The role slug default value.
     *
     * @var string
     */
    public const DEFAULT_SLUG = 'user';

    /**
     * The role name default value.
     *
     * @var string
     */
    public const DEFAULT_NAME = 'Користувач';
    
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_SLUG => self::DEFAULT_SLUG,
        self::COLUMN_NAME => self::DEFAULT_NAME
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('slug', function (Builder $builder) {
            $builder->where(static::COLUMN_SLUG, static::DEFAULT_SLUG)
                ->take(1);
        });
    }

}