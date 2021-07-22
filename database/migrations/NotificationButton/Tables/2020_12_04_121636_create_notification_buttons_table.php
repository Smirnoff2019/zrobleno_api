<?php

use App\Schemes\NotificationButton\NotificationButtonSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationButtonsTable extends Migration implements NotificationButtonSchema
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
            $table->string(self::COLUMN_URL)->nullable();
            $table->string(self::COLUMN_TYPE);
            $table->string(self::COLUMN_SERVICE);

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
