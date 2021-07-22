<?php

namespace App\Models\PasswordReset;

use App\Models\User\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Schemes\PasswordReset\PasswordResetSchema;

class PasswordReset extends Model implements PasswordResetSchema
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
        self::COLUMN_EMAIL,
        self::COLUMN_TOKEN,
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
        //
    ];

    public static function makeToken() 
    {
        return Str::random(32);
    }

    /**
     * Update or create password reset token for input email address
     *
     * @param  string $email
     * @return self
     */
    public static function forUser(User $user) 
    {
        return static::updateOrCreate(
            [
                'email' => $user->email
            ],
            [
                'email' => $user->email,
                'token' => static::makeToken()
            ]
        );
    }

    /**
     * Create a link to create a new user password
     *
     * @return string
     */
    public function makeLink() 
    {
        return "https://auth.zrobleno.com.ua/newpassword/{$this->token}";
    }
    
}
