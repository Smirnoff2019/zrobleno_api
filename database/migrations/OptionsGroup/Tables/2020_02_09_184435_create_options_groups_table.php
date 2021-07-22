<?php

use App\Schemes\DefaultSchema;
use App\Schemes\OptionsGroup\OptionsGroupSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsGroupsTable extends Migration implements OptionsGroupSchema
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
            $table->integer(self::COLUMN_SORT)->nullable();
            $table->string(self::COLUMN_POSITION_X)->nullable();
            $table->string(self::COLUMN_POSITION_Y)->nullable();
            $table->integer(self::COLUMN_DISPLAY)->nullable();

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
