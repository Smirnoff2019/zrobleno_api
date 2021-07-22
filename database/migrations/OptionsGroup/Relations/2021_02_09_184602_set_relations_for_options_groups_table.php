<?php

use App\Schemes\DefaultSchema;
use App\Schemes\Image\ImageSchema;
use App\Schemes\OptionsGroup\OptionsGroupSchema;
use App\Schemes\Room\RoomSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForOptionsGroupsTable extends Migration implements OptionsGroupSchema
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
             * @column COLUMN_ROOM_ID
             */
            $table->foreignId(self::COLUMN_ROOM_ID)
                ->nullable()
                ->after(self::COLUMN_DISPLAY)
                ->constrained(RoomSchema::TABLE)
                ->onDelete('set null');
            
            /**
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_ROOM_ID)
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

            $table->dropColumn(self::COLUMN_ROOM_ID);
            $table->dropColumn(self::COLUMN_IMAGE_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
