<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Schemes\Relations\BelongsTo\BelongsToParentSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  @method parent()
 *  @method children()
 */
trait BelongsToParent
{
    
    /**
     * Get the parent item for the this essence.
     * 
     * @return BelongsTo self
     */
    public function parent()
    {
        return $this->belongsTo(
            self::class, 
            BelongsToParentSchema::COLUMN_PARENT_ID
        );
    }

    /**
     * Get the children for the post.
     * 
     * @return HasMany self
     */
    public function children()
    {
        return $this->hasMany(
            static::class,
            BelongsToParentSchema::COLUMN_PARENT_ID
        );
    }

}
