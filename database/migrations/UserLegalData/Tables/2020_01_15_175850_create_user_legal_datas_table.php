<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\UserLegalData\UserLegalDataSchema;

class CreateUserLegalDatasTable extends Migration implements UserLegalDataSchema
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

            $table->string(self::COLUMN_BILL)->unique();
            $table->string(self::COLUMN_MFO)->nullable();
            $table->string(self::COLUMN_EDRPOU_CODE)->unique();
            $table->string(self::COLUMN_SERIAL_NUMBER)->unique();
            $table->string(self::COLUMN_LEGAL_STATUS)->nullable();

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
