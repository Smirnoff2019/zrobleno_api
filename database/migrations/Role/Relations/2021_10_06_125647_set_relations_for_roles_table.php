<?php

use App\Schemes\Image\ImageSchema;
use App\Schemes\Role\RoleSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForRolesTable extends Migration implements RoleSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table(self::TABLE, function (Blueprint $table) {

            /**
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_DESCRIPTION)
                ->constrained(ImageSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_IMAGE_ID)
                ->constrained(StatusSchema::TABLE)
                ->onDelete('set null');
                
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

            $table->dropColumn(self::COLUMN_IMAGE_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);
            
        });
    }
}
