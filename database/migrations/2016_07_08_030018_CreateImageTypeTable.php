<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagetypes', function (Blueprint $table) {
            $table->increments('id');
						$table->string('group');
						$table->string('type');
						$table->smallInteger('width');
						$table->smallInteger('height');
						$table->string('infotxt');
						$table->string('helptxt');
						$table->string('rules');
						$table->string('notes');
						$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imagetypes');
    }
}
