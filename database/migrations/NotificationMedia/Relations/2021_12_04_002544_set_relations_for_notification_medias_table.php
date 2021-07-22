<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\NotificationMedia\NotificationMediaSchema;
use App\Schemes\NotificationTemplate\NotificationTemplateSchema;

class SetRelationsForNotificationMediasTable extends Migration implements NotificationMediaSchema
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
             * @column COLUMN_TEMPLATE_ID
             */
            $table->foreignId(self::COLUMN_TEMPLATE_ID)
                ->nullable()
                ->after(self::COLUMN_MEDIA_ID)
                ->constrained(NotificationTemplateSchema::TABLE);

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

            $table->dropColumn(self::COLUMN_TEMPLATE_ID);

        });
    }
}
