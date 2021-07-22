<?php

namespace App\Schemes\Bot;

use App\Schemes\DefaultSchema;

interface BotMessagesSchema extends DefaultSchema
{

    public const TABLE = 'bot_messages';
    
    public const COLUMN_UPDATE_ID = 'update_id';
    public const COLUMN_MESSAGE = 'message';

}
