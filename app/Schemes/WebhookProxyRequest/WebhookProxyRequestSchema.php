<?php

namespace App\Schemes\WebhookProxyRequest;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface WebhookProxyRequestSchema extends DefaultSchema, BelongsToStatusSchema
{

    public const TABLE = 'webhook_proxy_requests';

    public const COLUMN_WEBHOOK_PROXY_ID    = 'webhook_proxy_id';
    public const COLUMN_DATA                = 'data';

}
