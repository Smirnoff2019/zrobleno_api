<?php

namespace App\Models\User\Contractor;

use App\Models\Portfolio\Portfolio;
use App\Models\Status\Tender\ActiveStatus;
use App\Models\User\User;
use App\Models\Tender\Tender;
use App\Models\TenderDeals\TenderDeals;
use App\Models\UserLegalData\UserLegalData;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TenderParticipant\TenderParticipant;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Status\Tender\RecruitmentOfParticipantsStatus;
use App\Models\Status\TenderDeals\AgreedStatus;
use App\Models\Status\TenderDeals\PendingStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contractor extends User
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();
        
        static::addGlobalScope(
            'contractor_role',
            function(Builder $builder) {
                return $builder->contractor();
            }
        );
    }

    /**
     * The users with role contractor that Many To Many to the tender.
     *
     * @return belongsToMany \App\Models\Tender\Tender
     */
    public function tenders()
    {
        return $this->belongsToMany(
            Tender::class,
            TenderParticipant::class,
            TenderParticipant::COLUMN_USER_ID,
            TenderParticipant::COLUMN_TENDER_ID
        );
    }

    /**
     * The users with role contractor that Many To Many to the tender.
     *
     * @return belongsToMany \App\Models\Tender\Tender
     */
    public function availableTenders()
    {
        return Tender::withCount(['participants'])
            ->whereHas('status', function (Builder $query) {
                return $query->where('type', RecruitmentOfParticipantsStatus::DEFAULT_SLUG)
                    ->orWhere('type', ActiveStatus::DEFAULT_SLUG);
            })
            ->whereNotIn(Tender::COLUMN_USER_ID, [$this->id])
            ->whereColumn([
                [Tender::COLUMN_FINISHED_AT, '>', Tender::COLUMN_STARTED_AT],
                [Tender::COLUMN_MAX_PARTICIPANTS, '>', 'participants_count']
            ])
            ->where(Tender::COLUMN_STARTED_AT, '>=', Carbon::today());
    }

    /**
     * The users with role contractor that Many To Many to the tender.
     *
     * @return hasMany \App\Models\tenderDeals\tenderDeals
     */
    public function tenderDeals()
    {
        return $this->hasMany(
            TenderDeals::class,
            'contractor_id',
            'id'
        );
    }

    /**
     * The users with role contractor that Many To Many to the tender.
     *
     * @return hasMany \App\Models\tenderDeals\tenderDeals
     */
    public function activeDealsWithCustomers()
    {
        return $this->tenderDeals()
            ->whereHas('status', function($query) {
                return $query->where('slug', PendingStatus::DEFAULT_SLUG);
            });
    }

    /**
     * The users with role contractor that Many To Many to the tender.
     *
     * @return hasMany \App\Models\TenderDeals\TenderDeals
     */
    public function agreedDealsWithCustomers()
    {
        return $this->tenderDeals()
            ->whereHas('status', function($query) {
                return $query->where('slug', AgreedStatus::DEFAULT_SLUG);
            });
    }

    /**
     * Get the user legal data.
     *
     * @return HasOne \App\Models\UserLegalData\UserLegalData
     */
    public function legalData(): HasOne
    {
        return $this->hasOne(
            UserLegalData::class, 
            'user_id',
            'id'
        )->oldest();
    }

}
