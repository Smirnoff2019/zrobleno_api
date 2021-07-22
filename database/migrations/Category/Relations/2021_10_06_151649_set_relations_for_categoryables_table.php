<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Schemes\Category\CategoryableSchema;
use App\Schemes\Category\CategorySchema;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForCategoryablesTable extends Migration implements CategoryableSchema
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
             * @column COLUMN_CATEGORY_ID
             */
            $table->foreignId(self::COLUMN_CATEGORY_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(CategorySchema::TABLE)
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

            $table->dropColumn(self::COLUMN_CATEGORY_ID);

        });
    }

}
