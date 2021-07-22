<?php

use App\Schemes\Account\AccountSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration implements AccountSchema
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

            $table->unsignedBigInteger(self::COLUMN_PID)->unique();
            $table->bigInteger(self::COLUMN_BALANCE)->nullable();
            $table->string(self::COLUMN_ACCOUNT_TYPE)->nullable();
            $table->unsignedBigInteger(self::COLUMN_USER_ID);

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
