<?php

use App\Schemes\User\UserSchema;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Portfolio\PortfolioSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\PortfolioImage\PortfolioImageSchema;

class SetRelationsForPortfoliosImagesTable extends Migration implements PortfolioImageSchema
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
             * @column COLUMN_PORTFOLIO_ID
             */
            $table->foreignId(self::COLUMN_PORTFOLIO_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(PortfolioSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_PORTFOLIO_ID)
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

            $table->dropColumn(self::COLUMN_PORTFOLIO_ID);
            $table->dropColumn(self::COLUMN_IMAGE_ID);

        });
    }
}
