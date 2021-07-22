<?php

namespace App\Models\TenderDeals;

use App\Models\Status\TenderDeals\PendingStatus;
use App\Models\Tender\Tender;
use App\Models\User\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Contractor\Contractor;
use App\Schemes\TenderDeals\TenderDealsSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToTender;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderDeals extends Model implements TenderDealsSchema
{
    use BelongsToStatus,
        BelongsToTender,
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
        self::COLUMN_CUSTOMER_ID,
        self::COLUMN_CONTRACTOR_ID,
        self::COLUMN_STATUS_ID,
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
     * Get the tender for the this essence.
     *
     * @return BelongsTo \App\Models\User\Customer Customer
     */
    public function customer()
    {
        return $this->belongsTo(
            Customer::class,
            TenderDealsSchema::COLUMN_CUSTOMER_ID
        );
    }

    /**
     * Get the tender for the this essence.
     *
     * @return BelongsTo \App\Models\User\Contractor Contractor
     */
    public function contractor()
    {
        return $this->belongsTo(
            Contractor::class,
            TenderDealsSchema::COLUMN_CONTRACTOR_ID
        );
    }

    /**
     * Get the tender for the this essence.
     *
     * @return self
     */
    public function scopeNewOffer($query, Tender $tender, Contractor $contractor)
    {
        $deal = $this->create();
        $deal->tender()->associate($tender);
        $deal->customer()->associate($tender->customer->id);
        $deal->contractor()->associate($contractor);
        $deal->status()->associate(PendingStatus::first());
        $deal->save();
        
        return $deal;
    }

}
