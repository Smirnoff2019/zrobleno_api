<?php

use App\Schemes\User\UserSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\Tender\TenderSchema;
use App\Schemes\Project\ProjectSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForTendersTable extends Migration implements TenderSchema
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
             * @column COLUMN_PROJECT_ID
             */
            $table->foreignId(self::COLUMN_PROJECT_ID)
                ->nullable()
                ->after(self::COLUMN_PRICE)
                ->constrained(ProjectSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_USER_ID)
                ->nullable()
                ->after(self::COLUMN_PROJECT_ID)
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
            
            $table->dropColumn(self::COLUMN_PROJECT_ID);
            $table->dropColumn(self::COLUMN_USER_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
