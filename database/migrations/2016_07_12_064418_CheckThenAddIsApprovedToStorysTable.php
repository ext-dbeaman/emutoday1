<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CheckThenAddIsApprovedToStorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			if (Schema::hasColumn('storys', 'is_approved')) {

			} else {
				Schema::table('storys', function (Blueprint $table) {
            $table->boolean('is_approved')->default(0);
        });
			}

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storys', function (Blueprint $table) {
            //
        });
    }
}
