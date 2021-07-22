<?php

namespace App\Models\Avatar;

use App\Schemes\Avatar\AvatarSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model implements AvatarSchema
{

    use BelongsToImage,
        BelongsToStatus;

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
        self::COLUMN_COLOR,
        self::COLUMN_GENDER,
        self::COLUMN_GROUP,
        self::COLUMN_IMAGE_ID,
        self::COLUMN_STATUS_ID,
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
     * Scope a query only blue avatars
     *
     * @param  Builder $query
     * @return Builder
     * 
     * @method blue() 
     */
    public function scopeBlue(Builder $query)
    {
        return $this->where(self::COLUMN_COLOR, 'blue');
    }

    /**
     * Scope a query only yellow avatars
     *
     * @param  Builder $query
     * @return Builder
     * 
     * @method yellow() 
     */
    public function scopeYellow(Builder $query)
    {
        return $this->where(self::COLUMN_COLOR, 'yellow');
    }

    /**
     * Scope a query only green avatars
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method green() 
     */
    public function scopeGreen(Builder $query)
    {
        return $this->where(self::COLUMN_COLOR, 'green');
    }

    /**
     * Scope a query only red avatars
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method red() 
     */
    public function scopeRed(Builder $query)
    {
        return $this->where(self::COLUMN_COLOR, 'red');
    }

    /**
     * Scope a query only purple avatars
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method purple() 
     */
    public function scopePurple(Builder $query)
    {
        return $this->where(self::COLUMN_COLOR, 'purple');
    }

    /**
     * Scope a query only male avatars
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method man() 
     */
    public function scopeMan(Builder $query)
    {
        return $this->where(self::COLUMN_GENDER, 'man');
    }

    /**
     * Scope a query only female avatars
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method woman() 
     */
    public function scopeWoman(Builder $query)
    {
        return $this->where(self::COLUMN_GENDER, 'woman');
    }

    /**
     * Scope to check it is a male avatar
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method isMan() 
     */
    public function scopeIsMan(Builder $query)
    {
        return $this->where(self::COLUMN_GENDER, 'man');
    }

    /**
     * Scope to check it is a female avatar
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method isWoman() 
     */
    public function scopeIsWoman(Builder $query)
    {
        return $this->where(self::COLUMN_GENDER, 'woman');
    }

}
