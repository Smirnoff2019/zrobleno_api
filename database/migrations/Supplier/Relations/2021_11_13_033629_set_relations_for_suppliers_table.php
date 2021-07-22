<?php

use App\Schemes\Image\ImageSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Schema;
use App\Schemes\Supplier\SupplierSchema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\SupplierCategory\SupplierCategorySchema;

class SetRelationsForSuppliersTable extends Migration implements SupplierSchema
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
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_CATALOG_URL)
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
            
            $table->dropColumn(self::COLUMN_IMAGE_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
