<?php

use App\Schemes\Portfolio\PortfolioSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration implements PortfolioSchema
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

            $table->string(self::COLUMN_NAME);
            $table->string(self::COLUMN_SLUG);
            $table->integer(self::COLUMN_TOTAL_AREA);
            $table->string(self::COLUMN_DURATION);
            $table->bigInteger(self::COLUMN_BUDGET);

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
