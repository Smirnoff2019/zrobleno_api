<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\Image\Image;

trait HasManyImages
{

    /**
     * Get the related Images
     * 
     * @return HasMany \App\Models\Image\Image
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
}
