<?php

namespace App\Models\UserChatBot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Schemes\UserChatBot\UserChatBotSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserChatBot extends Model implements UserChatBotSchema
{

    use Notifiable,
        BelongsToUser;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = "bots_db";

    /**
     * we use the table that corresponds to this model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * fields from the table to use.
     *
     * @var array
     */
    public $fillable = [
        self::COLUMN_APP,
        self::COLUMN_CHAT_ID,
        self::COLUMN_USER_ID,
        self::COLUMN_STATUS,
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_APP        => 'telegram',
        self::COLUMN_STATUS     => true,
    ];

    /**
     * Scope a query to only include users who have telegram app
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeTelegramApp($query)
    {
        return $query->where(self::COLUMN_APP, 'telegram');
    }

    /**
     * Scope a query to only include users from the specified chat
     *
     * @param  Builder  $query
     * @param  string  $chat_id
     * @return Builder
     */
    public function scopeChat($query, string $chat_id)
    {
        return $query->where(self::COLUMN_CHAT_ID, $chat_id);
    }

}
