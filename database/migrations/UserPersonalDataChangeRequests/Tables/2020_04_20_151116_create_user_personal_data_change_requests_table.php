<?php

use App\Schemes\UserPersonalDataChangeRequests\UserPersonalDataChangeRequestsSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPersonalDataChangeRequestsTable extends Migration implements UserPersonalDataChangeRequestsSchema
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

            $table->longText( self::COLUMN_DATA)->nullable();

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
