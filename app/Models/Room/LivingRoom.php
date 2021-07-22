<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Builder;

class LivingRoom extends Room
{

    /**
     * The role slug default value.
     *
     * @var string
     */
    public const DEFAULT_SLUG = 'living_room';

    /**
     * The role name default value.
     *
     * @var string
     */
    public const DEFAULT_NAME = 'Вітальня';

    /**
     * The room max count default value.
     *
     * @var integer
     */
    public const DEFAULT_MAX_COUNT = 1;

    /**
     * The room default count default value.
     *
     * @var integer
     */
    public const DEFAULT_DEFAULT_COUNT = 0;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_NAME           => self::DEFAULT_NAME,
        self::COLUMN_SLUG           => self::DEFAULT_SLUG,
        self::COLUMN_MAX_COUNT      => self::DEFAULT_MAX_COUNT,
        self::COLUMN_DEFAULT_COUNT  => self::DEFAULT_DEFAULT_COUNT,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('slug', function (Builder $builder) {
            $builder->where(
                self::COLUMN_SLUG,
                self::DEFAULT_SLUG
            );
        });

        parent::booted();
    }
    
}
