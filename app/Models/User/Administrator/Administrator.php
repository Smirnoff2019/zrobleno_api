<?php

namespace App\Models\User\Administrator;

use App\Models\ComplaintResponse\ComplaintResponse;
use App\Models\File\File;
use App\Models\Image\Image;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Administrator extends User
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(
            'admin_role',
            function(Builder $builder)
            {
                $builder->admin();
            }
        );
    }

    /**
     * Get the all images for the this user.
     *
     * @return HasManyThrough
     */
    public function images(): HasManyThrough
    {
        return $this->hasManyThrough(
            Image::class,
            File::class
        );
    }

}
