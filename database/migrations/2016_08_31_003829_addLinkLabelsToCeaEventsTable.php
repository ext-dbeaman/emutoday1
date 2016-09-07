<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkLabelsToCeaEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cea_events', function (Blueprint $table) {
            $table->string('related_link_1_txt')->after('related_link_1');
            $table->string('related_link_2_txt')->after('related_link_2');
            $table->string('related_link_3_txt')->after('related_link_3');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cea_events', function (Blueprint $table) {
            $table->dropColumn('related_link_1_txt');
            $table->dropColumn('related_link_2_txt');
            $table->dropColumn('related_link_3_txt');

        });
    }
}
