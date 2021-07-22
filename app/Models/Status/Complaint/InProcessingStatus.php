<?php

namespace App\Models\Status\Complaint;

use App\Models\Status\ComplaintStatus;
use Illuminate\Database\Eloquent\Builder;

class InProcessingStatus extends ComplaintStatus
{

    /**
     * The status's default name attribute value.
     *
     * @var string
     */
    const DEFAULT_NAME = 'В обробці';

    /**
     * The status's default slug attribute value.
     *
     * @var string
     */
    const DEFAULT_SLUG = 'in_processing';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_NAME   => self::DEFAULT_NAME,
        self::COLUMN_SLUG   => self::DEFAULT_SLUG,
        self::COLUMN_TYPE   => self::DEFAULT_SLUG,
        self::COLUMN_GROUP  => self::DEFAULT_GROUP
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {

        parent::booted();
        static::addGlobalScope('slug', function (Builder $builder) {
            $builder->where(
                self::COLUMN_SLUG,
                static::DEFAULT_SLUG
            );
        });

    }

}
