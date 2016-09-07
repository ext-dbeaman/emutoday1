<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriorityAndArchiveToAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->integer('priority')->default(0)->unsigned()->after('approved_date');
						$table->integer('archived')->default(0)->unsigned()->before('is_promoted');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
					$table->dropColumn('priority');
					$table->dropColumn('archived');
        });
    }
}
