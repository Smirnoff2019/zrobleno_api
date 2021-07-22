<?php

namespace App\Models\TenderParticipant;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use App\Traits\Eloquent\BelongsTo\BelongsToTender;
use App\Schemes\TenderParticipant\TenderParticipantSchema;

class TenderParticipant extends Model implements TenderParticipantSchema
{

    use BelongsToTender,
        BelongsToUser;

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
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        //
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
