<?php

use App\Schemes\File\FileSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration implements FileSchema
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

            $table->string(self::COLUMN_URL);
            $table->string(self::COLUMN_URI);
            $table->string(self::COLUMN_PATH);
            $table->string(self::COLUMN_NAME)->unique();
            $table->string(self::COLUMN_TITLE)->nullable();
            $table->text(self::COLUMN_DESCRIPTION)->nullable();
            $table->char(self::COLUMN_FORMAT);
            $table->char(self::COLUMN_SIZE);
            $table->char(self::COLUMN_SORT)->nullable();

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
