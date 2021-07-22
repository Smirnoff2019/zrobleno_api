<?php

use App\Schemes\Status\StatusSchema;
use App\Schemes\Tender\TenderSchema;
use App\Schemes\TenderRestart\TenderRestartSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForTenderRestartTable extends Migration implements TenderRestartSchema
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
             * @column COLUMN_TENDER_ID
             */
            $table->foreignId(self::COLUMN_TENDER_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(TenderSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_NEW_TENDER_ID
             */
            $table->foreignId(self::COLUMN_NEW_TENDER_ID)
                ->nullable()
                ->after(self::COLUMN_TENDER_ID)
                ->constrained(TenderSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_NEW_TENDER_ID)
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

            $table->dropColumn(self::COLUMN_TENDER_ID);
            $table->dropColumn(self::COLUMN_NEW_TENDER_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }

}
