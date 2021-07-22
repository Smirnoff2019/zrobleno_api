<?php

namespace App\Schemes\WebhookProxy;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface WebhookProxySchema extends DefaultSchema, BelongsToStatusSchema
{

    public const TABLE = 'webhook_proxies';

    public const COLUMN_NAME        = 'name';
    public const COLUMN_GROUP       = 'group';
    public const COLUMN_DOMAIN      = 'domain';
    public const COLUMN_URI         = 'uri';
    public const COLUMN_SSL         = 'ssl';

}
