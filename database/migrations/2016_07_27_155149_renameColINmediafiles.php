<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColINmediafiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mediafiles', function (Blueprint $table) {
            $table->renameColumn('link_url', 'link_text');
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
            $table->renameColumn('link_text','link_url');
        });
    }
}
