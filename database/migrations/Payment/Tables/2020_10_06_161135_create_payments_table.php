<?php

use App\Schemes\Payment\PaymentSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration implements PaymentSchema
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

            $table->bigInteger(self::COLUMN_VALUE)->nullable();
            $table->bigInteger(self::COLUMN_BALANCE)->nullable();
            $table->string(self::COLUMN_TYPE)->nullable();
            $table->string(self::COLUMN_ORDER_REFERENCE);
            $table->unsignedBigInteger('tender_id')->nullable();
            $table->boolean(self::COLUMN_IS_BONUS)->default(0);
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
