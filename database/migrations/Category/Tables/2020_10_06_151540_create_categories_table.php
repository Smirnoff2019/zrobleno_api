<?php

use Illuminate\Support\Facades\Schema;
use App\Schemes\Category\CategorySchema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration implements CategorySchema
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
