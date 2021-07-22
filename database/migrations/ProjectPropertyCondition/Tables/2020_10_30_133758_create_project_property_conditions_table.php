<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\ProjectPropertyCondition\ProjectPropertyConditionSchema;

class CreateProjectPropertyConditionsTable extends Migration implements ProjectPropertyConditionSchema
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

            $table->string( self::COLUMN_NAME )->nullable();
            $table->string( self::COLUMN_SLUG )->nullable()->unique();

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
