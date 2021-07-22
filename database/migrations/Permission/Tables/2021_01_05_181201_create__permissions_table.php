<?php

use App\Schemes\Permission\PermissionSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration implements PermissionSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(self::COLUMN_NAME);
            $table->string(self::COLUMN_SLUG)->unique();
            $table->text(self::COLUMN_DESCRIPTION)->nullable();

            $table->string(self::COLUMN_MODULE_NAME);
            $table->string(self::COLUMN_METHOD_NAME)->nullable();
            $table->unsignedBigInteger(self::COLUMN_PARENT_ID)->nullable();
            $table->unsignedBigInteger(self::COLUMN_POSITION)->nullable();

            $table->boolean(self::COLUMN_IS_ACTIVE)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
