<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\TenderApplication\TenderApplicationSchema;

class CreateTenderApplicationsTable extends Migration implements TenderApplicationSchema
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
