<?php
namespace App\Models\Bot\UserBotAuthToken;

use App\Models\UserChatBot;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserBotAuthToken extends Model
{

    use BelongsToUser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_bot_auth_token';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'bots_db';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'token',
        'active',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true,
    ];

    /**
     * Get curent user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get user chat with bot
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chatBot()
    {
        return $this->hasOne(
            UserChatBot::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Generate user auth token for chat bot
     *
     * @return string
     */
    public static function createToken(): string
    {
        return (string) Str::substr(
            md5(Str::random(16)),
            0,
            16
        );
    }

    /**
     * Generate user auth token for chat bot
     *
     * @return static
     */
    public static function makeForUser(int $user_id)
    {
        return static::firstOrCreate(
            [
                'user_id'   => $user_id,
            ],
            [
                'token'     => static::createToken()
            ]
        );
    }

    /**
     * Find user ID by his chat bot auth token
     *
     * @param  string $token
     * @return static|null
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function findByToken(string $token)
    {
        return static::whereToken($token)->firstOrFail();
    }

    /**
     * Find user chat bot auth tokens by his ID
     *
     * @param  int $user_id
     * @return static[]|null
     */
    public static function findByUserId(int $user_id)
    {
        return static::where('user_id', '=', $user_id)->latest()->firstOrFail();
    }

}
