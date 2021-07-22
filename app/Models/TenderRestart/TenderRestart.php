<?php

namespace App\Models\TenderRestart;

use Illuminate\Database\Eloquent\Model;
use App\Schemes\TenderRestart\TenderRestartSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToTender;
use App\Traits\Eloquent\BelongsTo\BelongsToTenderRestart;
use App\Traits\Models\Status\TenderRestartStatusesSetters;

class TenderRestart extends Model implements TenderRestartSchema
{

    use BelongsToTender,
        BelongsToTenderRestart,
        BelongsToStatus;

    use TenderRestartStatusesSetters;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_TENDER_ID,
        self::COLUMN_NEW_TENDER_ID,
        self::COLUMN_STATUS_ID,
    ];

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
