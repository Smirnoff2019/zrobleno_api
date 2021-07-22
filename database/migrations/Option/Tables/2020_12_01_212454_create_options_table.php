<?php

use App\Schemes\Option\OptionSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration implements OptionSchema
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

            $table->string(self::COLUMN_NAME)->nullable();
            $table->string(self::COLUMN_SLUG)->nullable()->unique();
            $table->text(self::COLUMN_DESCRIPTION)->nullable();
            $table->integer(self::COLUMN_PRICE)->nullable();
            $table->integer(self::COLUMN_COEFFICIENT)->nullable();
            $table->integer(self::COLUMN_QUANTITY)->nullable();
            $table->integer(self::COLUMN_DISPLAY)->nullable();
            $table->string(self::COLUMN_FORMULA_NAME)->nullable();
            $table->integer(self::COLUMN_DEFAULT)->nullable();
            $table->integer(self::COLUMN_SORT)->nullable();

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
