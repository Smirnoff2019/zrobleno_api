<?php

namespace App\Models\AccessToken;

use App\Schemes\AccessToken\AccessTokenSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AccessToken extends Model implements AccessTokenSchema
{

    use BelongsToUser;

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
        self::COLUMN_GROUP,
        self::COLUMN_TOKEN,
        self::COLUMN_ACTIVE,
        self::COLUMN_USER_ID,
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
     * Scope a query 
     *
     * @param Builder $query
     * @param bool    $state
     * @return Builder
     *
     * @method Builder defaultSelected()
     */
    public function scopeActive(Builder $query, bool $state = true): Builder
    {
        return $query->where(self::COLUMN_ACTIVE, $state);
    }

}
