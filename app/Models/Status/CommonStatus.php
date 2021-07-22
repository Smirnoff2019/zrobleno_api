<?php

namespace App\Models\Status;

use App\Models\Status\Status;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Models\Status\CommonStatusScopes;

class CommonStatus extends Status 
{

    use CommonStatusScopes;

    /**
     * The status's default group.
     *
     * @var string
     */
    public const DEFAULT_GROUP = 'common';

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
            $builder->whereGroup(static::DEFAULT_GROUP);
        });
    }

}
