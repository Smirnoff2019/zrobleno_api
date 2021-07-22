<?php

use App\Schemes\Account\AccountSchema;
use App\Schemes\Payment\PaymentSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForPaymentsTable extends Migration implements PaymentSchema
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
             * @column COLUMN_ACCOUNT_ID
             */
            $table->foreignId(self::COLUMN_ACCOUNT_ID)
                ->nullable()
                ->after(self::COLUMN_TYPE)
                ->constrained(AccountSchema::TABLE)
                ->onDelete('set null');
           
            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_ACCOUNT_ID)
                ->constrained(StatusSchema::TABLE)
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
           
            $table->dropColumn(self::COLUMN_ACCOUNT_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
