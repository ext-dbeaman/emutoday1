<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStoryImagesColumnsToBeMoreLikeMediaFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('story_images', function (Blueprint $table) {
            $table->string('title')->after('image_path');
						$table->string('link')->after('moretext');
						$table->string('link_text')->before('created_at');


						$table->string('group')->after('imagetype_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('story_images', function (Blueprint $table) {
             	$table->dropColumn('title');
							$table->dropColumn('link');
							$table->dropColumn('link_text');
        });
    }
}
