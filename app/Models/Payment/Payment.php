<?php

namespace App\Models\Payment;

use App\Models\Account\Account;
use App\Models\Status\Status;
use App\Schemes\Payment\PaymentSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToAccount;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model implements PaymentSchema
{

    use BelongsToStatus,
        BelongsToAccount;


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
        self::COLUMN_VALUE,
        self::COLUMN_BALANCE,
        self::COLUMN_TYPE,
        self::COLUMN_ACCOUNT_ID,
        self::COLUMN_STATUS_ID,
        self::COLUMN_ORDER_REFERENCE,
        self::COLUMN_IS_BONUS,
        'tender_id'
    ];

    public function scopeBonus ($query) {
        return $query->where(self::COLUMN_ACCOUNT_ID, request()->user()->account_id)->where(self::COLUMN_IS_BONUS, 1);
    }

    public function scopeMain ($query) {
        return $query->where(self::COLUMN_ACCOUNT_ID, request()->user()->account_id)->where(self::COLUMN_IS_BONUS, 0);
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * Retrieve personal account details for this payment
     *
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get a description of the status of this payment
     *
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Scope by payment type
     *
     * @param Builder $query
     * @return Builder
     * @method typeRefill()
     */
    public function scopeTypeRefill(Builder $query)
    {
        return $this->where('type', 'refill');
    }

    /**
     * Scope by payment type
     *
     * @param Builder $query
     * @return Builder
     * @method typeRefill()
     */
    public function scopeTypeDebit(Builder $query)
    {
        return $this->where('type', 'debit');
    }

    public function scopeHistory($query) {
        return $query->where('account_id', request()->user()->account_id);
    }


    public $eventType = 'payment';

    public function dataFormater () {
        return [
            self::COLUMN_VALUE => $this->{self::COLUMN_VALUE},
        ];
    }

    public function getActionUrl ($isContractor) {
        return $isContractor ? "https://contractor.zrobleno.com.ua/refill" : "https://customer.zrobleno.com.ua";
    }
}
