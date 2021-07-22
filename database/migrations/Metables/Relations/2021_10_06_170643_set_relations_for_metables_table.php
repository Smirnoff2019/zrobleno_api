<?php

use App\Schemes\Meta\MetaSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\Metables\MetablesSchema;

class SetRelationsForMetablesTable extends Migration implements MetablesSchema
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
             * @column COLUMN_META_ID
             */
            $table->foreignId(self::COLUMN_META_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(MetaSchema::TABLE)
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

            $table->dropColumn(self::COLUMN_META_ID);

        });
    }

}
