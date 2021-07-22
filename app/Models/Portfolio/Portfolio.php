<?php

namespace App\Models\Portfolio;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Model;
use App\Schemes\Portfolio\PortfolioSchema;
use App\Models\PortfolioImage\PortfolioImage;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;

class Portfolio extends Model implements PortfolioSchema
{

    use BelongsToUser,
        BelongsToStatus,
        BelongsToImage {
            BelongsToImage::image as cover; 
        }

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
        self::COLUMN_TOTAL_AREA,
        self::COLUMN_BUDGET,
        self::COLUMN_DURATION,
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
     * Get the customer of the tender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany \App\Models\User\User
     */
    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            PortfolioImage::class
        );
    }

}
