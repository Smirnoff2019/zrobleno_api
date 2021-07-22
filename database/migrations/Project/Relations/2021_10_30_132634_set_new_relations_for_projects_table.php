<?php

use App\Schemes\CalculatorOption\CalculatorOptionSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\Project\ProjectSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNewRelationsForProjectsTable extends Migration implements ProjectSchema
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
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_REGION_ID)
                ->nullable()
                ->after(self::COLUMN_ADDRESS)
                ->constrained(CalculatorOptionSchema::TABLE)
                ->onDelete('set null');
                
            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_CEILING_HEIGHT_ID)
                ->nullable()
                ->after(self::COLUMN_REGION_ID)
                ->constrained(CalculatorOptionSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_WALLS_CONDITION_ID)
                ->nullable()
                ->after(self::COLUMN_CEILING_HEIGHT_ID)
                ->constrained(CalculatorOptionSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_PROPERTY_CONDITION_ID)
                ->nullable()
                ->after(self::COLUMN_WALLS_CONDITION_ID)
                ->constrained(CalculatorOptionSchema::TABLE)
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

            $table->dropColumn(self::COLUMN_REGION_ID);
            $table->dropColumn(self::COLUMN_CEILING_HEIGHT_ID);
            $table->dropColumn(self::COLUMN_WALLS_CONDITION_ID);
            $table->dropColumn(self::COLUMN_PROPERTY_CONDITION_ID);

        });
    }
}
