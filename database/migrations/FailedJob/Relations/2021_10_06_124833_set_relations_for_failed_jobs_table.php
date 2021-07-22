<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Schemes\FailedJob\FailedJobSchema;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForFailedJobsTable extends Migration implements FailedJobSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table(self::TABLE, function (Blueprint $table) {
          
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
            
        });
    }
}
