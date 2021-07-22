<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\Project\Project;

trait HasManyProjects
{

    /**
     * Get the all projects 
     * 
     * @return HasMany 
     */
    public function projects()
    {
        return $this->hasMany(
            Project::class
        );
    }
    
}
