<?php

namespace App\Schemes\FailedJob;

use App\Schemes\DefaultSchema;

interface FailedJobSchema extends DefaultSchema
{

    public const TABLE = 'failed_jobs';
    
    public const COLUMN_CONNECTION = 'connection';
    public const COLUMN_QUEUE = 'queue';
    public const COLUMN_PAYLOAD = 'payload';
    public const COLUMN_EXCEPTION = 'exception';
    public const COLUMN_FAILED_AT = 'failed_at';

}
