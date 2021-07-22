<?php

namespace App\Models\PortfolioImage;

use App\Schemes\PortfolioImage\PortfolioImageSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model implements PortfolioImageSchema
{

    use BelongsToImage;

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
        self::COLUMN_IMAGE_ID,
        self::COLUMN_PORTFOLIO_ID,
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

}
