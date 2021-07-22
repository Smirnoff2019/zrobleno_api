<?php

use App\Schemes\Image\ImageSchema;
use App\Schemes\Post\PostSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\User\UserSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForPostsTable extends Migration implements PostSchema
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
             * @column COLUMN_PARENT_ID
             */
            $table->foreignId(self::COLUMN_PARENT_ID)
                ->nullable()
                ->after(self::COLUMN_POST_TYPE)
                ->constrained(self::TABLE);

            /**
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_USER_ID)
                ->nullable()
                ->after(self::COLUMN_PARENT_ID)
                ->constrained(UserSchema::TABLE);

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_USER_ID)
                ->constrained(StatusSchema::TABLE);

            /**
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_STATUS_ID)
                ->constrained(ImageSchema::TABLE);

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

            $table->dropColumn(self::COLUMN_PARENT_ID);
            $table->dropColumn(self::COLUMN_USER_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);
            $table->dropColumn(self::COLUMN_IMAGE_ID);

        });
    }
}
