<?php

use App\Schemes\Taxonomy\TaxonomySchema;
use App\Schemes\Taxonomyables\TaxonomyablesSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetRelationsForTaxonomyablesTable extends Migration implements TaxonomyablesSchema
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
             * @column COLUMN_TAXONOMY_ID
             */
            $table->foreignId(self::COLUMN_TAXONOMY_ID)
                ->nullable()
                ->after(self::COLUMN_ID)
                ->constrained(TaxonomySchema::TABLE)
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

            $table->dropColumn(self::COLUMN_TAXONOMY_ID);

        });
    }
}
