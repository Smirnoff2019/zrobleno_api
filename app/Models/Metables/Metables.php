<?php

namespace App\Models\Metables;

use App\Models\Meta\Meta;
use App\Schemes\Metables\MetablesSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Metables extends MorphPivot implements MetablesSchema
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_VALUE,
        self::COLUMN_ACTION,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        //
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_VALUE,
        self::COLUMN_ACTION
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //self::COLUMN_OPTIONS => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        //
    ];

    /**
     * Get the meta that it has.
     *
     * @return BelongsTo Meta
     */
    public function meta()
    {
        return $this->belongsTo(
            Meta::class,
            self::COLUMN_META_ID
        );
    }

}
