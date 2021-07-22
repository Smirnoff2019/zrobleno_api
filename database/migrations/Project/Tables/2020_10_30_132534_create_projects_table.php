<?php

use App\Schemes\Project\ProjectSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration implements ProjectSchema
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

            $table->integer( self::COLUMN_TOTAL_AREA )->nullable();
            $table->integer( self::COLUMN_TOTAL_PRICE )->nullable();
            $table->string( self::COLUMN_CITY )->nullable();
            $table->string( self::COLUMN_ADDRESS )->nullable();

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
