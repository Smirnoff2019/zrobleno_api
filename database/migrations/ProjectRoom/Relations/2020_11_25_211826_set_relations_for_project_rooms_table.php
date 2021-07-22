<?php

use App\Schemes\Room\RoomSchema;
use App\Schemes\Project\ProjectSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\ProjectRoom\ProjectRoomSchema;

class SetRelationsForProjectRoomsTable extends Migration implements ProjectRoomSchema
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
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_PROJECT_ID)
                ->nullable()
                ->after(self::COLUMN_AREA)
                ->constrained(ProjectSchema::TABLE)
                ->onDelete('set null');
           
            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_ROOM_ID)
                ->nullable()
                ->after(self::COLUMN_PROJECT_ID)
                ->constrained(RoomSchema::TABLE)
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
            //

            $table->dropColumn(self::COLUMN_PROJECT_ID);
            $table->dropColumn(self::COLUMN_ROOM_ID);

        });
    }
}
