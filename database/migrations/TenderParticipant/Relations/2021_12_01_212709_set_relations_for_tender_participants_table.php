<?php

use App\Schemes\User\UserSchema;
use App\Schemes\Tender\TenderSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\TenderParticipant\TenderParticipantSchema;

class SetRelationsForTenderParticipantsTable extends Migration implements TenderParticipantSchema
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
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_USER_ID)
                ->nullable()
                ->after(self::COLUMN_TENDER_ID)
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

            $table->dropColumn(self::COLUMN_TENDER_ID);
            $table->dropColumn(self::COLUMN_USER_ID);
            
        });
    }
}
