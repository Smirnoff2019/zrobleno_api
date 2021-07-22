<?php

namespace App\Models\Bot;

use App\Schemes\Bot\BotMessagesSchema;
use Illuminate\Database\Eloquent\Model;

class BotMessages extends Model implements BotMessagesSchema
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
        self::COLUMN_UPDATE_ID,
        self::COLUMN_MESSAGE,
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

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'bots_db';

}
