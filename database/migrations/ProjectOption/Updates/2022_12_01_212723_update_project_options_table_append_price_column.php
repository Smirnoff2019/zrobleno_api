<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\ProjectOption\ProjectOptionSchema;

class UpdateProjectOptionsTableAppendPriceColumn extends Migration implements ProjectOptionSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {

            $table->integer(self::COLUMN_PRICE)
                ->nullable()
                ->after(self::COLUMN_COUNT);
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            //
        });
    }
}
