<?php

use App\Schemes\Room\RoomSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration implements RoomSchema
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
            
            $table->string(self::COLUMN_NAME)->uniqid();
            $table->string(self::COLUMN_SLUG)->uniqid();
            $table->integer(self::COLUMN_SORT)->nullable();
            $table->integer(self::COLUMN_MAX_COUNT)->nullable();
            $table->integer(self::COLUMN_DEFAULT_COUNT)->nullable();

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
