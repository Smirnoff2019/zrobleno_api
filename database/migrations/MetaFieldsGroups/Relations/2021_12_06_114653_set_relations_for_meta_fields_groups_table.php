<?php

use App\Schemes\MetaFieldsGroups\MetaFieldsGroupsSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForMetaFieldsGroupsTable extends Migration implements MetaFieldsGroupsSchema
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
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_NAME)
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

            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
