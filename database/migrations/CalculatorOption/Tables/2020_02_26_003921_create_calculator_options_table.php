<?php

use App\Schemes\CalculatorOption\CalculatorOptionSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatorOptionsTable extends Migration implements CalculatorOptionSchema
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

            $table->string(self::COLUMN_TYPE)->nullable();
            $table->text(self::COLUMN_VALUE)->nullable();
            $table->string(self::COLUMN_SLUG)->nullable();
            $table->string(self::COLUMN_NAME)->nullable();
            $table->text(self::COLUMN_DESCRIPTION)->nullable();

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
