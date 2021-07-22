<?php

use App\Schemes\Image\ImageSchema;
use App\Schemes\ImagesGroup\ImagesGroupSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateImagesTable2 extends Migration implements ImageSchema
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
             * @column COLUMN_IMAGES_GROUP_ID
             */
            $table->foreignId(self::COLUMN_IMAGES_GROUP_ID)
                ->nullable()
                ->after(self::COLUMN_PARENT_ID)
                ->constrained(ImagesGroupSchema::TABLE)
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
            
            // ALTER TABLE `images` DROP FOREIGN KEY `images_images_group_id_foreign`;
            // ALTER TABLE `images` DROP COLUMN `images_group_id`;

            $table->dropIndex('images_images_group_id_foreign');
            $table->dropColumn(self::COLUMN_IMAGES_GROUP_ID);
        });
    }
}
