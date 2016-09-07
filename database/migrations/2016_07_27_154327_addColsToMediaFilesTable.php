<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToMediaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mediafiles', function (Blueprint $table) {
            $table->string('headline')->after('filename');
						$table->string('teaser')->after('caption');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mediafiles', function (Blueprint $table) {
					$table->dropColumn('headline');
					$table->dropColumn('teaser');
        });
    }
}
