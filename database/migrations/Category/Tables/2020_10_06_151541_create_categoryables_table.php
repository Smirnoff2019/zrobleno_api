<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Schemes\Category\CategoryableSchema;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryablesTable extends Migration implements CategoryableSchema
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
             * @name categoryable
             *   '-> @column categoryable_id
             *   '-> @column categoryable_type
             *
             * @type Morphs
             *   -> [string]
             *   -> [unsignedBigInteger]
             *
             * @index nullable
             **/
            $table->nullableMorphs('categoryable');

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
        //Schema::dropMorphs('categoryable');
    }
}
