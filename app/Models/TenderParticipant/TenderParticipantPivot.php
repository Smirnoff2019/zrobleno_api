<?php

namespace App\Models\TenderParticipant;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Schemes\TenderParticipant\TenderParticipantSchema;

class TenderParticipantPivot extends Pivot implements TenderParticipantSchema
{

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
        self::COLUMN_USER_ID,
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
