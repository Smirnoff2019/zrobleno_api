<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Schemes\MetaField\MetaFieldSchema;
use Illuminate\Database\Migrations\Migration;

class CreateMetaFieldsTable extends Migration implements MetaFieldSchema
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
            $table->text(self::COLUMN_OPTIONS)->nullable();

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
