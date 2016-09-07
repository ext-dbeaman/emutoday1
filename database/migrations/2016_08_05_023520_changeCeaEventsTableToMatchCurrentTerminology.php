<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCeaEventsTableToMatchCurrentTerminology extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cea_events', function (Blueprint $table) {
            $table->renameColumn('approved', 'is_approved');
            $table->renameColumn('canceled', 'is_canceled');
            $table->renameColumn('featured', 'is_featured');
            $table->boolean('is_promoted')->after('lbc_approved')->default(0);
            $table->integer('priority')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->renameColumn('is_approved', 'approved');
        $table->renameColumn('is_canceled','canceled');
        $table->renameColumn( 'is_featured','featured');
        $table->dropColumn('is_promoted');
        $table->dropColumn('priority');
    }
}
