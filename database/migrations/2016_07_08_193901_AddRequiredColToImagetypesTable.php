<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequiredColToImagetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagetypes', function (Blueprint $table) {
            $table->boolean('is_required')->default(0)->after('height');

        });

				Schema::table('story_types', function (Blueprint $table) {
            $table->string('group')->after('shortname')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagetypes', function (Blueprint $table) {
					$table->dropColumn('is_required');

        });
    }
}
