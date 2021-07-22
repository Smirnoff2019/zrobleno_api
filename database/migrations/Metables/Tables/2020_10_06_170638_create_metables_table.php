<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Schemes\Metables\MetablesSchema;

class CreateMetablesTable extends Migration implements MetablesSchema
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
             * @name metable
             *   '-> @column metable_id
             *   '-> @column metable_type
             *
             * @type Morphs
             *   -> [string]
             *   -> [unsignedBigInteger]
             *
             * @index nullable
             **/
            $table->nullableMorphs('metable');
            $table->text(self::COLUMN_VALUE)->nullable();
            $table->text(self::COLUMN_ACTION)->nullable();

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
