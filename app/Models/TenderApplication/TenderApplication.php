<?php

namespace App\Models\TenderApplication;

use App\Models\Status\TenderApplication\ConfirmedStatus;
use App\Models\Tender\Tender;
use App\Schemes\TenderApplication\TenderApplicationSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Models\Status\TenderApplicationStatusesSetters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TenderApplication extends Model implements TenderApplicationSchema
{

    use BelongsToStatus;

    use TenderApplicationStatusesSetters;

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
        self::COLUMN_STATUS_ID,
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
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'tender',
        'status',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updated(function ($application) {
            $application->refresh();
            
            // if($application->status->type == ConfirmedStatus::DEFAULT_SLUG) {
            //     $application->tender->setAsRecruitmentOfParticipants();
                
            // }
        });
    }

    /**
     * Get the tender uid
     *
     * @return string
     */
    public function getUidAttribute()
    {
        return $this->tender->uid ?? null;
    }

    /**
     * Get the tender name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->tender->name ?? null;
    }

    /**
     * Get the tender price
     *
     * @return string
     */
    public function getPriceAttribute()
    {
        return $this->tender->price ?? null;
    }

    /**
     * Get the tender for the this essence.
     *
     * @return BelongsTo \App\Models\Tender\Tender
     */
    public function tender()
    {
        return $this->hasOne(
            Tender::class,
            Tender::COLUMN_APPLICATION_ID,
            self::COLUMN_ID,
        );
    }

    /**
     * Get the tender customer
     *
     * @return BelongsTo \App\Models\User\User
     */
    public function customer()
    {
        return $this->tender()->getResults()->customer();
    }

}
