<?php

use App\Schemes\PermissionRole\PermissionRoleSchema;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Schemes\Role\RoleSchema;
use App\Schemes\Permission\PermissionSchema;

class SetRelationsForPermissionRoleTable extends Migration implements PermissionRoleSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->foreign(self::COLUMN_ROLE_ID)->references(self::COLUMN_ID)->on(RoleSchema::TABLE)->onDelete('cascade');
            $table->foreign(self::COLUMN_PERMISSION_ID)->references(self::COLUMN_ID)->on(PermissionSchema::TABLE)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            //
        });
    }
}
