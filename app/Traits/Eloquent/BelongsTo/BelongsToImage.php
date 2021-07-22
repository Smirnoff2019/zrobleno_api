<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Image\Image;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @method image()
 */ 
trait BelongsToImage
{

    /**
     * Get the image for the this essence.
     * 
     * @return BelongsTo \App\Models\Image\Image
     */
    public function image()
    {
        return $this->belongsTo(
            Image::class,
            BelongsToImageSchema::COLUMN_IMAGE_ID
        );
    }
    
}
