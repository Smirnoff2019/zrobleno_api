<?php

namespace App\Models\Status;

use App\Traits\Models\Status\ComplaintStatusScopes;
use Illuminate\Database\Eloquent\Builder;

class ComplaintStatus extends Status
{

    use ComplaintStatusScopes;

    /**
     * The status's default group.
     *
     * @var string
     */
    const DEFAULT_GROUP = 'complaint';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_GROUP => self::DEFAULT_GROUP
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {

        static::addGlobalScope('group', function (Builder $builder) {
            $builder->where('group', static::DEFAULT_GROUP);
        });

    }

}
