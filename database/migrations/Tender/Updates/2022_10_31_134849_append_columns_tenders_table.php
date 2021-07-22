<?php

use App\Models\TenderApplication\TenderApplication;
use App\Schemes\Tender\TenderSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppendColumnsTendersTable extends Migration implements TenderSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            
            $table->string(self::COLUMN_UID)
                ->after(self::COLUMN_ID)
                ->nullable();

            /**
             * @column COLUMN_APPLICATION_ID
             */
            $table->foreignId(self::COLUMN_APPLICATION_ID)
                ->nullable()
                ->after(self::COLUMN_STARTED_AT)
                ->constrained(TenderApplication::TABLE)
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
            
            $table->dropColumn(self::COLUMN_UID);
            $table->dropColumn(self::COLUMN_APPLICATION_ID);
            
        });
    }
}
