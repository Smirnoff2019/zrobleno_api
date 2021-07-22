<?php

use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\SupplierCategory\SupplierCategorySchema;

class SetRelationsForSuppliersCategoriesTable extends Migration implements SupplierCategorySchema
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
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_SLUG)
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
           
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
