<?php

use App\Schemes\Post\PostSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration implements PostSchema
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
            $table->string(self::COLUMN_TITLE)->nullable();
            $table->text(self::COLUMN_DESCRIPTION)->nullable();
            $table->text(self::COLUMN_CONTENT)->nullable();
            $table->string(self::COLUMN_POST_TYPE)->nullable();

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
