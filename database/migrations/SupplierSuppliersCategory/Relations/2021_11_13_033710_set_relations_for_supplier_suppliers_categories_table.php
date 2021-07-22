<?php

use App\Schemes\Status\StatusSchema;
use App\Schemes\Supplier\SupplierSchema;
use App\Schemes\SupplierCategory\SupplierCategoryPivotSchema;
use App\Schemes\SupplierCategory\SupplierCategorySchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForSupplierSuppliersCategoriesTable extends Migration implements SupplierCategoryPivotSchema
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
             * @column COLUMN_SUPPLIER_ID
             */
            $table->foreignId(self::COLUMN_SUPPLIER_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(SupplierSchema::TABLE)
                ->onDelete('set null');   

            /**
             * @column COLUMN_SUPPLIER_CATEGORY_ID
             */
            $table->foreignId(self::COLUMN_SUPPLIER_CATEGORY_ID)
                ->nullable()
                ->after(self::COLUMN_SUPPLIER_ID)
                ->constrained(SupplierCategorySchema::TABLE)
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
           
            $table->dropColumn(self::COLUMN_SUPPLIER_ID);
            $table->dropColumn(self::COLUMN_SUPPLIER_CATEGORY_ID);

        });
    }
}
