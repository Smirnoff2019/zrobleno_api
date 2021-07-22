<?php

use App\Schemes\Account\AccountSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Schemes\AccountType\AccountTypeSchema;

class SetRelationsForAccountsTable extends Migration implements AccountSchema
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
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_PID)
                ->constrained(StatusSchema::TABLE)
                ->onDelete('set null');

            $table->foreign(self::COLUMN_ACCOUNT_TYPE)
                ->references(AccountTypeSchema::COLUMN_SLUG)
                ->on(AccountTypeSchema::TABLE)
                ->onDelete('set null');

            $table->foreign(self::COLUMN_USER_ID)
                ->references(self::COLUMN_ID)
                ->on(\App\Schemes\User\UserSchema::TABLE)
                ->onDelete('cascade');



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

            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
