<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Project\Project;

/**
 *  @method project()
 */
trait BelongsToProject
{

    /**
     * Get the project for the this essence.
     * 
     * @return BelongsTo \App\Models\Project\Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
