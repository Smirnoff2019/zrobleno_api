<?php

use App\Schemes\DefaultSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\WebhookProxy\WebhookProxySchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\WebhookProxyRequest\WebhookProxyRequestSchema;

class SetRelationsForWebhookProxyRequestsTable extends Migration implements WebhookProxyRequestSchema
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
             * @column COLUMN_WEBHOOK_PROXY_ID
             */
            $table->foreignId(self::COLUMN_WEBHOOK_PROXY_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(WebhookProxySchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_DATA)
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

            $table->dropColumn(self::COLUMN_WEBHOOK_PROXY_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
