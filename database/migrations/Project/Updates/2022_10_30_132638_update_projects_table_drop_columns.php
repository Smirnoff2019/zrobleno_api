<?php

use App\Schemes\Project\ProjectSchema;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class UpdateProjectsTableDropColumns extends Migration implements ProjectSchema
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            
            if (Schema::hasColumn(self::TABLE, 'ceiling_height')) {
                $table->dropColumn('ceiling_height');
            }
            
            if (Schema::hasColumn(self::TABLE, 'project_property_condition_id')) {
                $table->dropForeign('projects_project_property_condition_id_foreign');
                $table->dropColumn('project_property_condition_id');
            }
            
            if (!Schema::hasColumn(self::TABLE, self::COLUMN_COMPONENTS)) {
                $table->longText( self::COLUMN_COMPONENTS )
                    ->after(self::COLUMN_ADDRESS)
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
        });
    }
}
