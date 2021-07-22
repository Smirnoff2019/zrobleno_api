<?php

use App\Schemes\User\UserSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Schemes\Complaint\ComplaintSchema;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\ComplaintRecipient\ComplaintRecipientSchema;

class SetRelationsForComplaintsRecipientsTable extends Migration implements ComplaintRecipientSchema
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
             * @column COLUMN_COMPLAINT_ID
             */
            $table->foreignId(self::COLUMN_COMPLAINT_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(ComplaintSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_USER_ID)
                ->nullable()
                ->after(self::COLUMN_COMPLAINT_ID)
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

            $table->dropColumn(self::COLUMN_COMPLAINT_ID);
            $table->dropColumn(self::COLUMN_USER_ID);

        });
    }
}
