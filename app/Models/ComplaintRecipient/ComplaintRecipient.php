<?php

namespace App\Models\ComplaintRecipient;

use App\Models\Complaint\Complaint;
use App\Schemes\ComplaintRecipient\ComplaintRecipientSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintRecipient extends Model implements ComplaintRecipientSchema
{

    use BelongsToUser;

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
        //self::COLUMN_,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        //
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
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        //
    ];

    /**
     * Get the complaint for the this essence.
     *
     * @return BelongsTo \App\Models\User\Customer Customer
     */
    public function complaint()
    {
        return $this->belongsTo(
            Complaint::class,
            ComplaintRecipient::COLUMN_COMPLAINT_ID
        );
    }

}
