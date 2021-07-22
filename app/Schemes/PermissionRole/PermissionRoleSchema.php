<?php

namespace App\Schemes\PermissionRole;

use App\Schemes\DefaultSchema;

interface PermissionRoleSchema extends DefaultSchema
{

    public const TABLE = 'roles_permissions';

    public const COLUMN_ROLE_ID = 'role_id';
    public const COLUMN_PERMISSION_ID = 'permission_id';
}
