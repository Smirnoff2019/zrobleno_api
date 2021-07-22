<?php

use App\Schemes\Meta\MetaSchema;
use App\Schemes\MetaField\MetaFieldSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForMetaTable extends Migration implements MetaSchema
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
             * @column COLUMN_PARENT_ID
             */
            $table->foreignId(self::COLUMN_PARENT_ID)
                ->nullable()
                ->after(self::COLUMN_DESCRIPTION)
                ->constrained(self::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_META_FIELD_ID
             */
            $table->foreignId(self::COLUMN_META_FIELD_ID)
                ->nullable()
                ->after(self::COLUMN_PARENT_ID)
                ->constrained(MetaFieldSchema::TABLE)
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

            $table->dropColumn(self::COLUMN_PARENT_ID);
            $table->dropColumn(self::COLUMN_META_FIELD_ID);

        });
    }
}
