<?php

use App\Schemes\Image\ImageSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\File\FileSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForImagesTable extends Migration implements ImageSchema
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
             * @column COLUMN_FILE_ID
             */
            $table->foreignId(self::COLUMN_FILE_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(FileSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_PARENT_ID
             */
            $table->foreignId(self::COLUMN_PARENT_ID)
                ->nullable()
                ->after(self::COLUMN_FILE_ID)
                ->constrained(self::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_PARENT_ID)
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

            $table->dropColumn(self::COLUMN_FILE_ID);
            $table->dropColumn(self::COLUMN_PARENT_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
