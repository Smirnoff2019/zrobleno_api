<?php

use App\Schemes\Role\RoleSchema;
use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Schema;
use App\Schemes\Supplier\SupplierSchema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\SupplierDiscount\SupplierDiscountSchema;

class SetRelationsForSuppliersDiscountsTable extends Migration implements SupplierDiscountSchema
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
                ->after(self::COLUMN_VALUE)
                ->constrained(SupplierSchema::TABLE)
                ->onDelete('set null');
                
            /**
             * @column COLUMN_ROLE_ID
             */
            $table->foreignId(self::COLUMN_ROLE_ID)
                ->nullable()
                ->after(self::COLUMN_SUPPLIER_ID)
                ->constrained(RoleSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_ROLE_ID)
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
            
            $table->dropColumn(self::COLUMN_SUPPLIER_ID);
            $table->dropColumn(self::COLUMN_ROLE_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
