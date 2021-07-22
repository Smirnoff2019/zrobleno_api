<?php

use App\Schemes\Option\OptionSchema;
use App\Schemes\Project\ProjectSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\ProjectRoom\ProjectRoomSchema;
use App\Schemes\ProjectOption\ProjectOptionSchema;

class SetRelationsForProjectOptionsTable extends Migration implements ProjectOptionSchema
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
             * @column COLUMN_OPTION_ID
             */
            $table->foreignId(self::COLUMN_OPTION_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(OptionSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_PROJECT_ROOM_ID
             */
            $table->foreignId(self::COLUMN_PROJECT_ROOM_ID)
                ->nullable()
                ->after(self::COLUMN_OPTION_ID)
                ->constrained(ProjectRoomSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_PROJECT_ID
             */
            $table->foreignId(self::COLUMN_PROJECT_ID)
                ->nullable()
                ->after(self::COLUMN_PROJECT_ROOM_ID)
                ->constrained(ProjectSchema::TABLE)
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

            $table->dropColumn(self::COLUMN_OPTION_ID);
            $table->dropColumn(self::COLUMN_PROJECT_ROOM_ID);
            $table->dropColumn(self::COLUMN_PROJECT_ID);
            
        });
    }
}
