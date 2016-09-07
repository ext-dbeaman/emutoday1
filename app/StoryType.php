<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class StoryType extends Model
{
    protected $fillable = ['name', 'shortname'];

    /**
     * [storys description]
     * @return [type] [description]
     */
    public function storys()
    {
        return $this->hasMany('emutoday\Story', 'story_type');
    }

		
}
