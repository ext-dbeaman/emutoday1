<?php

use Illuminate\Database\Seeder;

class StoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storys')->truncate();

        DB::table('storys')->insert([
            [
                'author_id' => 1,
                'title' => 'Story 1 Title',
                'slug' => 'story-1',
                'subtitle' => 'Story 1 SubTitle',
                'teaser' => 'This is the teaser for story 1',
                'body' => 'this is the body for story 1',
                'publish_at'=> date('Y-m-d H:i:s', strtotime('now'))
            ],
            [
                'author_id' => 2,
                'title' => 'Story 2 Title',
                'slug' => 'story-2',
                'subtitle' => 'Story 2 SubTitle',
                'teaser' => 'This is the teaser for story 2',
                'body' => 'this is the body for story 2',
                'publish_at'=> date('Y-m-d H:i:s', strtotime('+ 2 weeks'))
            ],
            [
                'author_id' => 1,
                'title' => 'Story 3 Title',
                'slug' => 'story-3',
                'subtitle' => 'Story 3 SubTitle',
                'teaser' => 'This is the teaser for story 3',
                'body' => 'this is the body for story 3',
                'publish_at'=> null
            ],
        ]);
    }
}
