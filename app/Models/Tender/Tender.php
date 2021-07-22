<?php

namespace App\Models\Tender;

use Carbon\Carbon;
use App\Models\User\User;
use App\Traits\Logs\Loger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Schemes\Tender\TenderSchema;
use App\Models\TenderDeals\TenderDeals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Status\Tender\ActiveStatus;
use App\Models\TenderRestart\TenderRestart;
use App\Models\Status\Tender\CanceledStatus;
use App\Models\Status\TenderDeals\PendingStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Models\TenderApplication\TenderApplication;
use App\Models\TenderParticipant\TenderParticipant;
use App\Traits\Eloquent\BelongsTo\BelongsToProject;
use App\Traits\Models\Status\TenderStatusesSetters;
use App\Traits\Eloquent\HasMany\HasManyDiscountCards;
use App\Traits\Eloquent\HasOne\HasOneTenderApplication;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\Status\TenderApplication\ConfirmedStatus;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;
use App\Models\Status\Tender\RecruitmentOfParticipantsStatus;
use App\Models\Status\TenderApplication\AwaitingConfirmationStatus as TenderApplicationAwaitingConfirmationStatus;
use App\Traits\Filters\Filterable;

class Tender extends Model implements TenderSchema
{

    use BelongsToStatus,            // @status
        BelongsToProject,           // @project
        BelongsToUser,              // @user
        HasOneTenderApplication,    // @application
        HasManyDiscountCards;       // @discountCards

    use TenderStatusesSetters, 
        Filterable,
        Loger;

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
        self::COLUMN_UID,
        self::COLUMN_NAME,
        self::COLUMN_MAX_PARTICIPANTS,
        self::COLUMN_PRICE,
        self::COLUMN_APPLICATION_ID,
        self::COLUMN_STATUS_ID,
        self::COLUMN_STARTED_AT,
        self::COLUMN_FINISHED_AT,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        self::COLUMN_UID,
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
        self::COLUMN_STARTED_AT,
        self::COLUMN_FINISHED_AT,
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        
    }
    
    /**
     * Create new random uid attribute
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeCreateRandUid(Builder $query)
    {
        return $this->uid = Str::padLeft(rand($this->id ?? 10, 999999), 6, 0);
    }
    /**
     * Build a filter query by uid
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeUidLike(Builder $query, $uid)
    {
        return $query->where('uid', 'like', "%$uid%");
    }
    
    /**
     * Get the customer of the tender
     *
     * @param  int  $tender_id
     * @return string|int
     * 
     * @method tenderPrice(int $tender_id)
     */
    public function scopeTenderPrice($query, int $tender_id)
    {
        return $query->select([self::COLUMN_PRICE])->findOrFail($tender_id)->{self::COLUMN_PRICE};
    }

    /**
     * Tenders where dosn`t have participants (user) with id 
     *
     * @param  Builder  $query
     * @param  int  $user_id
     * @return $query
     * 
     * @method withoutParticipant(int $user_id)
     */
    public function scopeWithoutParticipant(Builder $query, int $user_id)
    {
        return $query->whereDoesntHave('participants', function (Builder $query) use($user_id) {
            $query->where('user_id', $user_id);
        });
    }

    /**
     * Tenders where dosn`t have participants (user) with id 
     *
     * @param  Builder  $query
     * @param  string  $statusSlug
     * @return $query
     * 
     * @method haveStatus(string $statusSlug)
     */
    public function scopeHaveStatus(Builder $query, string $type)
    {
        return $query->whereHas('status', function (Builder $query) use($type) {
            $query->where('type', $type);
        });
    }

    /**
     * Tenders where dosn`t have participants (user) with id 
     *
     * @param  Builder  $query
     * @param  int  $user_id
     * @return $query
     * 
     * @method haveRecruitmentOfParticipantsStatus()
     */
    public function scopeHaveRecruitmentOfParticipantsStatus(Builder $query)
    {
        return $query->haveStatus(RecruitmentOfParticipantsStatus::DEFAULT_SLUG);
    }

    /**
     * Tenders where dosn`t have participants (user) with id 
     *
     * @param  Builder  $query
     * @param  int  $user_id
     * @return $query
     * 
     * @method availableTenders()
     */
    public function scopeAvailableTenders(Builder $query, $contractor_id)
    {
        return $this
            ->has('participants', '>=', 0)
            ->withoutParticipant($contractor_id)
            ->whereHas('status', function (Builder $query) {
                $query->where('type', RecruitmentOfParticipantsStatus::DEFAULT_SLUG)
                    ->orWhere('type', ActiveStatus::DEFAULT_SLUG);
            })
            ->withCount(['participants'])
            ->whereNotIn(Tender::COLUMN_USER_ID, [$contractor_id])
            ->whereColumn(Tender::COLUMN_FINISHED_AT, '>', Tender::COLUMN_STARTED_AT)
            ->where(Tender::COLUMN_STARTED_AT, '>=', Carbon::today());
    }

    /**
     * Get the 
     *
     * @return string
     * @property $pid
     */
    public function getPidAttribute()
    {
        return Str::padLeft($this->id, 6, 0);
    }

    /**
     * Does can restarting tender
     *
     * @return bool
     * @property $can_restarting
     */
    public function getCanRestartingAttribute()
    {   
        return ($this->status->type ?? '') === ActiveStatus::DEFAULT_SLUG;
        // return $this->started_at->diffInDays(today()) >= 7;
    }

    /**
     * Does can customer offer deal to contractors 
     *
     * @return bool
     * @property $can_offer_deals
     */
    public function getCanOfferDealsAttribute()
    {   
        return $this->status->type == ActiveStatus::DEFAULT_SLUG || ((bool) $this->activeDeal ?? false);
    }

    /**
     * Does can contractor look at customer personal data 
     *
     * @return bool
     * @property $can_show_customer_data
     */
    public function getCanShowCustomerDataAttribute()
    {   
        return $this->hasShowCustomerData();
    }

    /**
     * Does can contractor look at customer personal data 
     *
     * @return bool
     * @property $can_customer_reject_tender_application
     */
    public function getCanCustomerRejectTenderApplicationAttribute()
    {   
        return $this->application->status->type == TenderApplicationAwaitingConfirmationStatus::DEFAULT_SLUG;
    }

    /**
     * Does can any body create new complaints
     *
     * @return bool
     * @property $can_create_new_complaints
     */
    public function getCanCreateNewComplaintsAttribute()
    {   
        return $this->status->type == ActiveStatus::DEFAULT_SLUG;
    }

    /**
     * Terms of reference url
     *
     * @return string
     * @property $terms_of_reference_url
     */
    public function getTermsOfReferenceUrlAttribute()
    {   
        return route('tenders.pdf', $this->id);
    }

    /**
     * Get the 
     *
     * @return string
     */
    public function hasShowCustomerData()
    {   
        if($this->status->type == ActiveStatus::DEFAULT_SLUG) {
            return true;
        }

        return $this->started_at->diffInDays(today()) >= 1 
                && $this->status->type != AwaitingConfirmationStatus::DEFAULT_SLUG
                && $this->status->type != CanceledStatus::DEFAULT_SLUG;
    }

    /**
     * Get the all tender participants users models.
     * 
     * @return HasMany \App\Models\User\User
     */
    public function participants()
    {
        return $this->belongsToMany(
            User::class,
            TenderParticipant::class,
        );
    }

    /**
     * Get the tender application
     *
     * @return BelongsTo \App\Models\TenderApplication\TenderApplication
     */
    public function application()
    {
        return $this->belongsTo(
            TenderApplication::class,
            self::COLUMN_APPLICATION_ID
        );
    }

    /**
     * Get the customer of the tender
     *
     * @return BelongsTo \App\Models\User\User
     */
    public function customer()
    {
        return $this->belongsTo(
            User::class,
            BelongsToUserSchema::COLUMN_USER_ID
        );
    }

    /**
     * Build a search query  
     * 
     * @param  Builder  $query
     * @param  Request  $request
     * @return Builder
     * 
     * @method queryFilters(Request $request)
     */
    public function scopeQueryFilters(Builder $query, Request $request) {
        return $query
            ->when(
                $request->get('orderBy', null), 
                function($query, $orderBy) use($request) {
                    
                    switch ($orderBy) {
                        case 'participants_count':
                            $query->withCount([
                                'participants'
                            ]);
                            break;
                    }
                    
                    return $query->orderBy(
                        $orderBy,
                        $request->direction ?? 'desc',
                    );
                },
                function($query) use($request) {
                    return $request->get('direction', 'desc') === 'asc'
                        ? $query->oldest()
                        : $query->latest();
                }
            )
            ->when(
                $request->get('name', null), 
                function($query, $name) use($request) {
                    return $query->where('name', 'like', "%$name%");
                }
            )
            ->when(
                $request->get('status', null), 
                function($query, $slug) use($request) {
                    return $query->whereHas('status', function($query) use($slug) {
                        return $query->where('slug', 'like', "$slug");
                    });
                }
            )
            ->when(
                $request->get('from', null), 
                function($query, $from) use($request) {
                    return $query->whereDate(Tender::COLUMN_STARTED_AT, '>=', Carbon::parse($from));
                }
            )
            ->when(
                $request->get('to', null), 
                function($query, $to) use($request) {
                    return $query->whereDate(Tender::COLUMN_STARTED_AT, '<=', Carbon::parse($to));
                }
            )
            ->when(
                $request->get('uid', null), 
                function($query, $uid) use($request) {
                    return $this->where('uid', 'like', "%$uid%");
                }
            );
    }

    /**
     * Get the user for the this essence.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function offerToRestart()
    {
        return $this->hasOne(
            TenderRestart::class,
            BelongsToTenderSchema::COLUMN_TENDER_ID
        );
    }

    /**
     * Get the deals with contractors for tender
     *
     * @return HasMany TenderDeals
     */
    public function deals()
    {
        return $this->hasMany(
            TenderDeals::class,
        );
    }

    /**
     * Get the deals with contractors for tender
     *
     * @return HasMany TenderDeals
     */
    public function activeDeals()
    {
        return $this->hasMany(
            TenderDeals::class,
        )->whereHas('status', function($query) {
            return $query->whereSlug(PendingStatus::DEFAULT_SLUG);
        })->oldest();
    }

    /**
     * Get the deals with contractors for tender
     *
     * @return HasMany TenderDeals
     */
    public function activeDeal()
    {
        return $this->hasOne(
            TenderDeals::class,
        )->whereHas('status', function($query) {
            return $query->whereSlug(PendingStatus::DEFAULT_SLUG);
        })->oldest();
    }

}
