<?php

use App\Schemes\Option\OptionSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class AppendParamsColumnToOptionsTable extends Migration implements OptionSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            
            if (!Schema::hasColumn(self::TABLE, self::COLUMN_MIDDLEWARES)) {
                
                $table->longText( self::COLUMN_MIDDLEWARES )
                    ->after(self::COLUMN_DESCRIPTION)
                    ->nullable();
                    
            }

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
            //
            $table->dropColumn(self::COLUMN_MIDDLEWARES);

        });
    }
}
