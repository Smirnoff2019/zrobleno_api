<?php

use App\Schemes\User\UserSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\UserLegalData\UserLegalDataSchema;

class SetRelationsForUserLegalDatasTable extends Migration implements UserLegalDataSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {

            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_USER_ID)
                ->nullable()
                ->after(self::COLUMN_LEGAL_STATUS)
                ->constrained(UserSchema::TABLE)
                ->onDelete('set null');
                
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
            $table->dropColumn(self::COLUMN_USER_ID);
        });
    }
}
