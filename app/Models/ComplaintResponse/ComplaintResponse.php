<?php

namespace App\Models\ComplaintResponse;

use App\Models\Complaint\Complaint;
use App\Schemes\ComplaintResponse\ComplaintResponseSchema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintResponse extends Model implements ComplaintResponseSchema
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
        self::COLUMN_COMPLAINT_ID,
        self::COLUMN_RESPONSE_ID,
        self::COLUMN_USER_ID
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
     * Complaints to this response
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function complaint()
    {
        return $this->belongsToMany(
            Complaint::class,
            ComplaintResponse::COLUMN_RESPONSE_ID,
            Complaint::COLUMN_ID
        );
    }

}
