<?php

namespace App\Models\Account;

use App\Models\Payment\Payment;
use App\Models\User\User;
use App\Models\UserAccount\UserAccount;
use App\Schemes\Account\AccountSchema;
use App\Schemes\UserAccount\UserAccountSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;

class Account extends Model implements AccountSchema
{

    use BelongsToAccount;

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
            self::COLUMN_PID, //
            self::COLUMN_BALANCE,
            self::COLUMN_STATUS_ID
        ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * Get the user for this account.
     *
     * @return hasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Retrieve payment history for this personal account
     *
     * @return hasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Retrieve payment history for this personal account
     *
     * @return hasMany
     */
    public static function createUserMainAccount(User $user)
    {
        $pid = rand(1000, 9999) . rand(1000, 9999) . rand(10, 99);
        
        factory(static::class)->state('main')->create([
            static::COLUMN_PID => $pid,
            self::COLUMN_USER_ID => $user->id
        ])->user()->save($user);
    }

    /**
     * Retrieve payment history for this personal account
     *
     * @return hasMany
     */
    public static function createUserBonusAccount(User $user)
    {
        $pid = rand(1000, 9999) . rand(1000, 9999) . rand(10, 99);
        
        factory(static::class)->state('bonus')->create([
            static::COLUMN_PID => $pid,
            self::COLUMN_USER_ID => $user->id
        ])->user()->save($user);
    }

}
