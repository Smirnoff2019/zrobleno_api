<?php

namespace App\Models\User;

use App\Models\Complaint\Complaint;
use App\Models\ComplaintResponse\ComplaintResponse;
use App\Models\File\File;
use App\Models\Tender\Tender;
use App\Models\Image\Image;
use App\Models\Post\Post;
use App\Models\Account\Account;
use App\Models\Avatar\Avatar;
use App\Models\UserLegalData\UserLegalData;
use App\Models\UserPhone\UserPhone;
use App\Schemes\User\UserSchema;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\UserChatBot\UserChatBot;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Models\User\UserRoleScopes;
use App\Traits\Eloquent\BelongsTo\BelongsToRole;
use App\Traits\Eloquent\HasMany\HasManyProjects;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToAccount;
use App\Models\Bot\UserBotAuthToken\UserBotAuthToken;
use App\Models\ComplaintRecipient\ComplaintRecipient;
use App\Models\Portfolio\Portfolio;
use App\Models\TenderApplication\TenderApplication;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;
use App\Traits\Eloquent\HasMany\HasManyDiscountCards;
use App\Traits\Eloquent\HasMany\HasManyTenders;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Models\User\UserTenderParticipant;

class User extends Authenticatable implements UserSchema
{

    use HasApiTokens,
        Notifiable,
        UserRoleScopes,
        BelongsToAccount,
        BelongsToImage,
        BelongsToStatus,
        BelongsToRole,
        HasManyProjects,
        HasManyTenders,
        HasManyDiscountCards,
        UserTenderParticipant;

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
        self::COLUMN_FIRST_NAME,
        self::COLUMN_MIDDLE_NAME,
        self::COLUMN_LAST_NAME,
        self::COLUMN_GENDER,
        self::COLUMN_PHONE,
        self::COLUMN_EMAIL,
        self::COLUMN_EMAIL_VERIFIED_AT,
        self::COLUMN_PASSWORD,
        self::COLUMN_REMEMBER_TOKEN,
        self::COLUMN_ROLE_ID,
        self::COLUMN_STATUS_ID,
        self::COLUMN_IMAGE_ID,
        self::COLUMN_ACCOUNT_ID,
        self::COLUMN_AVATAR_ID,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        self::COLUMN_PASSWORD,
        self::COLUMN_REMEMBER_TOKEN
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::COLUMN_EMAIL_VERIFIED_AT => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $user->createAccount();
            $user->findUserBotAuthToken();
        });
    }

    /**
     * Get the user fillable.
     *
     * @return array
     */
    public function getFillable() : array
    {
        return $this->fillable ?? [];
    }

    /**
     * Make hash user`s password.
     *
     * @var string $password
     * @return string
     */
    public static function makeHashPassword(string $password) : string
    {
        return Hash::make($password);
    }

    /**
     * Get the all categories for the this user.
     * @return HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get the all accounts for the this user.
     *
     * @return HasMany
     */
    public function accounts()
    {
        return $this->hasMany(
            Account::class,
            Account::COLUMN_USER_ID
        );
    }

    /**
     * Get the user avatar
     *
     * @return belongsTo
     */
    public function avatar()
    {
        return $this->belongsTo(
            Avatar::class,
            self::COLUMN_AVATAR_ID
        );
    }

    /**
     * Get the all post for the this user.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the all user portfolios
     *
     * @return HasMany
     */
    public function portfolios()
    {
        return $this->hasMany(
            Portfolio::class,
            Portfolio::COLUMN_USER_ID
        );
    }

    /**
     * Get the user's full name.
     *
     * @return string
     * 
     * @property $full_name
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name} {$this->middle_name}";
    }

    /**
     * Account main where has refill payments
     *
     * @return HasMany \App\Models\Account\Account
     * 
     * @property $is_active_main_account
     */
    public function getIsActiveMainAccountAttribute()
    {
        return (bool) $this->accountMainHasRefillPayments()->count() > 0;
    }

    /**
     * Account main where has refill payments
     *
     * @return HasMany \App\Models\Account\Account
     * 
     * @property $accountMainHasRefillPayments
     */
    public function accountMainHasRefillPayments()
    {
        return $this->accountMain()->whereHas('payments', function($query) {
            $query->typeRefill();
        });
    }

    /**
     * Account main where has debit payments
     *
     * @return string
     * 
     * @property $mainAccountPaymentsDebit
     */
    public function accountMainHasDebitPayments()
    {
        return $this->accountMain()->whereHas('payments', function($query) {
            $query->typeDebit();
        });
    }
    
    /**
     * Get the user last discount expirated at datetime.
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @property $discount_expirated_at
     */
    public function getDiscountExpiratedAtAttribute($query)
    {
        return $this->discountCards()
            ->latest('expirated_at')
            ->value('expirated_at');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function createAccount()
    {
        Account::createUserMainAccount($this);
        Account::createUserBonusAccount($this);

        return $this;
    }

    /**
     * Get the user bot auth token.
     *
     * @return HasOne \App\Models\Bot\UserBotAuthToken\UserBotAuthToken
     */
    public function userBotAuthToken()
    {
        return $this->hasOne(UserBotAuthToken::class);
    }

    /**
     * Get the user chat bot app data.
     *
     * @return HasOne \App\Models\UserChatBot\UserChatBot
     */
    public function chatBot()
    {
        return $this->hasOne(UserChatBot::class);
    }

    /**
     * Get the user chat bot app data.
     *
     * @return HasOne \App\Models\UserChatBot\UserChatBot
     */
    public function chatBotApp()
    {
        return $this->hasOne(UserChatBot::class)->select(UserChatBot::COLUMN_APP);
    }

    /**
     * Scope a query to only include users who have telegram app
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeHasChatBot($query)
    {
        return $query->has('chatBot');
    }

    /**
     * Scope a query to find the main account
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeAccountMain($query)
    {
        return $this->accounts()->where('account_type', 'main');
    }

    /**
     * Scope a query to find the bonus account
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeAccountBonus($query)
    {
        return $this->accounts()->where('account_type', 'bonus');
    }

    /**
     * Scope a query only man users
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method man() 
     */
    public function scopeMan($query)
    {
        return $this->where(self::COLUMN_GENDER, 'man');
    }

    /**
     * Scope a query only woman users
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method woman() 
     */
    public function scopeWoman($query)
    {
        return $this->where(self::COLUMN_GENDER, 'woman');
    }

    /**
     * Scope to check if the user is man
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method isMan() 
     */
    public function scopeIsMan($query)
    {
        return $this->where(self::COLUMN_GENDER, 'man');
    }

    /**
     * Scope to check if the user is woman
     *
     * @param  Builder  $query
     * @return Builder
     * 
     * @method isWoman() 
     */
    public function scopeIsWoman($query)
    {
        return $this->where(self::COLUMN_GENDER, 'woman');
    }

    /**
     * isEnoughtMoney
     *
     * @param  $price
     * @return self
     */
    public function isEnoughtMoney($price)
    {
        return $this->accounts->sum('balance') >= $price;
    }

    /**
     * Find users tender by `id`
     *
     * @param  Builder  $query
     * @param  int $tender_id
     * @return \App\Models\Tender\Tender
     */
    public function scopeTenderById($query, int $tender_id)
    {
        return $this->tenders()
            ->where('id', $tender_id)
            ->firstOrFail();
    }

    /**
     * Get (find or create) the user bot auth token.
     *
     * @return HasOne \App\Models\Bot\UserBotAuthToken\UserBotAuthToken
     */
    public function findUserBotAuthToken()
    {
        return $this->userBotAuthToken()->firstOrCreate(
            [],
            UserBotAuthToken::make([
                'token'     => UserBotAuthToken::createToken()
            ])->toArray()
        );
    }


    /**
     * Get the tenders applications for the this essence.
     *
     * @return HasManyThrough \App\Models\TenderApplication\TenderApplication
     */
    public function tenderApplications()
    {
        return $this->hasManyThrough(
            TenderApplication::class,
            Tender::class
        );
    }

    /**
     * Get the all images for the this user.
     *
     * @return HasManyThrough \App\Models\Tender\Tender
     */
    public function images()
    {
        return $this->hasManyThrough(
            Image::class,
            File::class
        );
    }

    /**
     * Get the user legal data.
     *
     * @return HasOne \App\Models\UserLegalData\UserLegalData
     */
    public function legalData()
    {
        return $this->hasOne(UserLegalData::class)->oldest();
    }

    /**
     * Get the user phones
     *
     * @return HasMany \App\Models\UserPhone\UserPhone
     */
    public function phones()
    {
        return $this->hasMany(
            UserPhone::class,
            BelongsToUserSchema::COLUMN_USER_ID
        );
    }

    /**
     * User complaints
     *
     * @return HasMany Complaint
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Complaints to this user
     *
     * @return BelongsToMany Complaint
     */
    public function complaintsToMe()
    {
        return $this->belongsToMany(
            Complaint::class, 
            ComplaintRecipient::class
        );
    }

    /**
     * User complaints
     *
     * @return HasMany Complaint
     */
    public function complaintRecipient()
    {
        return $this->hasMany(ComplaintRecipient::class);
    }

    /**
     * Get the all responses for the this user.
     *
     * @return HasManyThrough \App\Models\Complaint\Complaint
     */
    public function answers()
    {
        return $this->hasManyThrough(
            Complaint::class,
            ComplaintResponse::class,
            'user_id',
            'id',
            'id',
            'response_id'
        );
    }

    /**
     * User responses
     *
     * @return HasMany \App\Models\ComplaintResponse\ComplaintResponse
     */
    public function answer()
    {
        return $this->hasMany(ComplaintResponse::class);
    }

}
