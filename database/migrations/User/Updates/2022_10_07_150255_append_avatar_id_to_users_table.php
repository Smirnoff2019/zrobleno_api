<?php

use App\Schemes\Avatar\AvatarSchema;
use App\Schemes\User\UserSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppendAvatarIdToUsersTable extends Migration implements UserSchema
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
             * @column COLUMN_AVATAR_ID
             */
            $table->foreignId(self::COLUMN_AVATAR_ID)
                ->nullable()
                ->after(self::COLUMN_ROLE_ID)
                ->constrained(AvatarSchema::TABLE)
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
            
            $table->dropColumn(self::COLUMN_AVATAR_ID);
            
        });
    }
}
