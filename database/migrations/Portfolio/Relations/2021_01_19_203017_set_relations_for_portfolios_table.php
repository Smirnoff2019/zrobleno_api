<?php

use App\Schemes\Image\ImageSchema;
use App\Schemes\Portfolio\PortfolioSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\User\UserSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForPortfoliosTable extends Migration implements PortfolioSchema
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
             * @column COLUMN_USER_ID
             */
            $table->foreignId(self::COLUMN_USER_ID)
                ->nullable()
                ->after(self::COLUMN_BUDGET)
                ->constrained(UserSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_USER_ID)
                ->constrained(ImageSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_IMAGE_ID)
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

            $table->dropColumn(self::COLUMN_USER_ID);
            $table->dropColumn(self::COLUMN_IMAGE_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);
            
        });
    }
}
