<?php

use App\Schemes\DefaultSchema;
use App\Schemes\WebhookProxy\WebhookProxySchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebhookProxiesTable extends Migration implements WebhookProxySchema
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

            $table->string(self::COLUMN_NAME)
                ->nullable()
                ->unique();

            $table->string(self::COLUMN_GROUP)
                ->nullable();

            $table->string(self::COLUMN_DOMAIN)
                ->nullable()
                ->unique();

            $table->string(self::COLUMN_URI)
                ->nullable();

            $table->boolean(self::COLUMN_SSL)
                ->nullable()
                ->default(true);

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
