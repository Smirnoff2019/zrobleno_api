<?php

namespace App\Schemes\Post;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToParentSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface PostSchema extends DefaultSchema, BelongsToParentSchema, BelongsToUserSchema, BelongsToStatusSchema, BelongsToImageSchema
{

    /**
     * table name in database
     */
    const TABLE = 'posts';

    /**
     * columns name in table
     */
    const COLUMN_SLUG            = 'slug';
    const COLUMN_TITLE           = 'title';
    const COLUMN_DESCRIPTION     = 'description';
    const COLUMN_CONTENT         = 'content';
    const COLUMN_POST_TYPE       = 'post_type';

}
