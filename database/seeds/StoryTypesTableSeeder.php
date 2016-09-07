<?php

use Illuminate\Database\Seeder;

class StoryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('story_types')->truncate();
        DB::table('story_types')->insert([
            [
                'name' => 'News Story',
                'shortname' => 'storybasic',
                'level' => 0
            ],
            [
                'name' => 'Promoted Story',
                'shortname' => 'storypromoted',
                'level' => 1
            ],
            [
                'name' => 'Student Profile',
                'shortname' => 'storystudent',
                'level' => 1
            ],
            [
                'name' => 'Magazine Story',
                'shortname' => 'storymagazine',
                'level' => 1
            ],
            [
                'name' => 'External Story',
                'shortname' => 'storyexternal',
                'level' => 0
            ],

        ]);
    }
}
