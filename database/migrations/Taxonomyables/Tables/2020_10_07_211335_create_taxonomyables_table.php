<?php

use App\Schemes\Taxonomyables\TaxonomyablesSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyablesTable extends Migration implements TaxonomyablesSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();

            /**
             * @name taxonomyable
             *   '-> @column taxonomyable_id
             *   '-> @column taxonomyable_type
             *
             * @type Morphs
             *   -> [string]
             *   -> [unsignedBigInteger]
             *
             * @index nullable
             **/
            $table->nullableMorphs('taxonomyable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
