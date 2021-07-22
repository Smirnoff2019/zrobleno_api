<?php

use App\Schemes\Room\RoomSchema;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Option\OptionSchema;
use App\Schemes\OptionsGroup\OptionsGroupSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForOptionsTable extends Migration implements OptionSchema
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
                ->after(self::COLUMN_DESCRIPTION)
                ->constrained(RoomSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_OPTIONS_GROUP_ID
             */
            $table->foreignId(self::COLUMN_OPTIONS_GROUP_ID)
                ->nullable()
                ->after(self::COLUMN_ROOM_ID)
                ->constrained(OptionsGroupSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_OPTIONS_GROUP_ID)
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
            $table->dropColumn(self::COLUMN_OPTIONS_GROUP_ID);
            $table->dropColumn(self::COLUMN_IMAGE_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);
            
        });
    }
}
