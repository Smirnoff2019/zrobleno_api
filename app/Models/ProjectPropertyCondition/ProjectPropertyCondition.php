<?php

namespace App\Models\ProjectPropertyCondition;

use App\Schemes\ProjectPropertyCondition\ProjectPropertyConditionSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;

class ProjectPropertyCondition extends Model implements ProjectPropertyConditionSchema
{

    use BelongsToStatus;

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
        self::COLUMN_NAME,
        self::COLUMN_SLUG,
        self::COLUMN_STATUS_ID,
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
        //
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
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
     * Scope a query to only include property `slug` matches the specified value
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, string $slug)
    {
        return $query->where(
            self::COLUMN_SLUG,
            $slug
        );
    }

    /**
     * Scope a query to only include property `name` matches the specified value
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query, string $name)
    {
        return $query->where(
            self::COLUMN_SLUG,
            $name
        );
    }

    /**
     * Scope a query to only include property `slug`:`new-building`
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewBuilding($query)
    {
        return $query->where(
            self::COLUMN_SLUG,
            NewBuildingProjectPropertyCondition::DEFAULT_SLUG
        );
    }

    /**
     * Scope a query to only include property `slug`:`secondary-building`
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSecondaryBuilding($query)
    {
        return $query->where(
            self::COLUMN_SLUG,
            SecondaryBuildingProjectPropertyCondition::DEFAULT_SLUG
        );
    }

}
