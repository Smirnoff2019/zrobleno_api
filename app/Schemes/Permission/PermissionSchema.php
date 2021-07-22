<?php

namespace App\Schemes\Permission;

use App\Schemes\DefaultSchema;

interface PermissionSchema extends DefaultSchema
{

    public const TABLE = 'permissions';

    public const COLUMN_NAME = "name";
    public const COLUMN_SLUG = "slug";
    public const COLUMN_DESCRIPTION = "description";
    public const COLUMN_MODULE_NAME = "module_name";
    public const COLUMN_METHOD_NAME = "method_name";
    public const COLUMN_PARENT_ID = "parent_id";
    public const COLUMN_IS_ACTIVE = "is_active";
    public const COLUMN_POSITION = "position";

}
