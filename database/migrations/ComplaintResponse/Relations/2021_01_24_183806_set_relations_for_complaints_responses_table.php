<?php

use App\Models\ComplaintRecipient\ComplaintRecipient;
use App\Schemes\Complaint\ComplaintSchema;
use App\Schemes\User\UserSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\ComplaintResponse\ComplaintResponseSchema;

class SetRelationsForComplaintsResponsesTable extends Migration implements ComplaintResponseSchema
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
             * @column COLUMN_RESPONSE_ID
             */
            $table->foreignId(self::COLUMN_RESPONSE_ID)
                ->nullable()
                ->after(self::COLUMN_COMPLAINT_ID)
                ->constrained(ComplaintSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_USER_ID)
                ->nullable()
                ->after(self::COLUMN_RESPONSE_ID)
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
            $table->dropColumn(self::COLUMN_RESPONSE_ID);
            $table->dropColumn(self::COLUMN_USER_ID);

        });
    }
}
