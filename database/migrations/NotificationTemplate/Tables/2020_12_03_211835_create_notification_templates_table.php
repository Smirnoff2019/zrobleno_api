<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\NotificationTemplate\NotificationTemplateSchema;

class CreateNotificationTemplatesTable extends Migration implements NotificationTemplateSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string(self::COLUMN_NAME);
            $table->string(self::COLUMN_SLUG);
            $table->text(self::COLUMN_CONTENT)->nullable();
            $table->string(self::COLUMN_NOTIFICATION_NAME)->nullable();
            $table->string(self::COLUMN_GROUP_SLUG)->nullable();
            $table->string(self::COLUMN_STATUS_SLUG)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
