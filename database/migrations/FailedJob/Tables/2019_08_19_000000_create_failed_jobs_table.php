<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Schemes\FailedJob\FailedJobSchema;
use Illuminate\Database\Migrations\Migration;

class CreateFailedJobsTable extends Migration implements FailedJobSchema
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
            $table->text(self::COLUMN_CONNECTION);
            $table->text(self::COLUMN_QUEUE);
            $table->longText(self::COLUMN_PAYLOAD);
            $table->longText(self::COLUMN_EXCEPTION);
            $table->timestamp(self::COLUMN_FAILED_AT)->useCurrent();
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
