<?php

use App\Schemes\Image\ImageSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\NotificationType\NotificationTypeSchema;
use App\Schemes\NotificationGroup\NotificationGroupSchema;
use App\Schemes\NotificationTemplate\NotificationTemplateSchema;

class SetRelationsForNotificationTemplatesTable extends Migration implements NotificationTemplateSchema
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
             * @column COLUMN_GROUP_SLUG
             */
            $table->foreign(self::COLUMN_GROUP_SLUG)
                ->references(NotificationGroupSchema::COLUMN_SLUG)
                ->on(NotificationGroupSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_COVER_ID
             */
            $table->foreignId(self::COLUMN_COVER_ID)
                ->nullable()
                ->after(self::COLUMN_GROUP_SLUG)
                ->constrained(ImageSchema::TABLE)
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

            $table->dropColumn(self::COLUMN_COVER_ID);

        });
    }
}
