<?php


namespace App\Traits\Eloquent\BelongsTo;

use App\Models\File\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @method file()
 */ 
trait BelongsToFile
{
    /**
     * Get the image for the this essence.
     *
     * @return BelongsTo \App\Models\File\File
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}