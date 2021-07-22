<?php

namespace App\Schemes\UserPersonalDataChangeRequests;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface UserPersonalDataChangeRequestsSchema extends DefaultSchema, BelongsToUserSchema, BelongsToStatusSchema
{

    public const TABLE = 'user_personal_data_change_requests';

    public const COLUMN_DATA = 'data';

}
