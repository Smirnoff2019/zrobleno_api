<?php

use App\Schemes\Tender\TenderSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTendersTable extends Migration implements TenderSchema
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

            $table->string(self::COLUMN_NAME)
                ->nullable();
            $table->integer(self::COLUMN_MAX_PARTICIPANTS)
                ->default(0)
                ->nullable();
            $table->integer(self::COLUMN_PRICE)
                ->default(0)
                ->nullable();
            
            $table->timestamp(self::COLUMN_STARTED_AT)
                ->nullable();
            $table->timestamp(self::COLUMN_FINISHED_AT)
                ->nullable();

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
