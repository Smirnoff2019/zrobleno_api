<?php

namespace App\Schemes\Image;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToParentSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToFileSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImagesGroupSchema;

interface ImageSchema extends DefaultSchema, BelongsToFileSchema, BelongsToParentSchema, BelongsToStatusSchema, BelongsToImagesGroupSchema
{

    /**
     * table name in database
     */
    const TABLE = 'images';

}
