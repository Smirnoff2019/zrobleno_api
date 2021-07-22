<?php

use App\Schemes\Image\ImageSchema;
use App\Schemes\User\UserSchema;
use App\Schemes\Role\RoleSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\Account\AccountSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRelationsForUsersTable extends Migration implements UserSchema
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
             * @column COLUMN_ROLE_ID
             */
            $table->foreignId(self::COLUMN_ROLE_ID)
                ->nullable()
                ->after(self::COLUMN_REMEMBER_TOKEN)
                ->constrained(RoleSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_IMAGE_ID
             */
            $table->foreignId(self::COLUMN_IMAGE_ID)
                ->nullable()
                ->after(self::COLUMN_ROLE_ID)
                ->constrained(ImageSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_ACCOUNT_ID
             */
            $table->foreignId(self::COLUMN_ACCOUNT_ID)
                ->nullable()
                ->after(self::COLUMN_IMAGE_ID)
                ->constrained(AccountSchema::TABLE)
                ->onDelete('set null');

            /**
             * @column COLUMN_STATUS_ID
             */
            $table->foreignId(self::COLUMN_STATUS_ID)
                ->nullable()
                ->after(self::COLUMN_ACCOUNT_ID)
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

            $table->dropColumn(self::COLUMN_ROLE_ID);
            $table->dropColumn(self::COLUMN_IMAGE_ID);
            $table->dropColumn(self::COLUMN_ACCOUNT_ID);
            $table->dropColumn(self::COLUMN_STATUS_ID);

        });
    }
}
