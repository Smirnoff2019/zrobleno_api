<?php

namespace App\Schemes\UserChatBot;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface UserChatBotSchema extends DefaultSchema, BelongsToUserSchema
{

    public const TABLE = 'user_chat_bots';

    public const COLUMN_CHAT_ID      = 'chat_id';
    public const COLUMN_APP          = 'app';
    public const COLUMN_STATUS       = 'status';

}
