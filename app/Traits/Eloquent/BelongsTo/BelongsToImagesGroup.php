<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\ImagesGroup\ImagesGroup;
use App\Schemes\Relations\BelongsTo\BelongsToImagesGroupSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @method imagesGroup()
 */
trait BelongsToImagesGroup
{

    /**
     * Get the images group
     * 
     * @return BelongsTo \App\Models\ImagesGroup\ImagesGroup
     */
    public function imagesGroup()
    {
        return $this->belongsTo(
            ImagesGroup::class,
            BelongsToImagesGroupSchema::COLUMN_IMAGES_GROUP_ID
        );
    }

}
