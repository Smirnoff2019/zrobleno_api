<?php

use App\Schemes\User\UserSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Schemes\Complaint\ComplaintSchema;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForComplaintsTable extends Migration implements ComplaintSchema
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
                ->after(self::COLUMN_MESSAGE)
                ->constrained(UserSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_USER_ID)
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
            
            $table->dropColumn(self::COLUMN_USER_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
