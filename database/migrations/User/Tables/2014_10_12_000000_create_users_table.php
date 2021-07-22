<?php

use App\Schemes\User\UserSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration implements UserSchema
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
           
            $table->string(self::COLUMN_FIRST_NAME)->nullable();
            $table->string(self::COLUMN_MIDDLE_NAME)->nullable();
            $table->string(self::COLUMN_LAST_NAME)->nullable();
            $table->char(self::COLUMN_PHONE, 50)->nullable();
            $table->string(self::COLUMN_EMAIL)->unique();
            $table->timestamp(self::COLUMN_EMAIL_VERIFIED_AT)->nullable();
            $table->string(self::COLUMN_PASSWORD);
            $table->rememberToken();

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
