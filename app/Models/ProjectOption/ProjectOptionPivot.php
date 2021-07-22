<?php

namespace App\Models\ProjectOption;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Schemes\ProjectOption\ProjectOptionSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToOption;
use App\Traits\Eloquent\BelongsTo\BelongsToProject;

class ProjectOptionPivot extends Pivot implements ProjectOptionSchema
{

    use BelongsToOption,
        BelongsToProject;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];
    

}
