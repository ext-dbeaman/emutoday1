<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use emutoday\Story;
use Laracasts\Presenter\PresentableTrait;

class StoryImage extends Model
{
    use PresentableTrait;
    protected $presenter = 'emutoday\Presenters\StoryImagePresenter';

    protected $fillable = ['story_id',
                            'is_active',
                            'image_name',
                            'image_path',
														'title',
                            'caption',
                            'teaser',
                            'moretext',
														'link',
														'link_text',
                            'image_extension',
                            'image_type',
														'imagetype_id',
														'group'
    ];
    /**
    * All of the relationships to be touched.
    *
    * @var array
    */
    protected $touches = ['story'];

    public function story()
    {
        return $this->belongsTo('emutoday\Story');
    }

		public function imgtype()
		{
			return $this->belongsTo('emutoday\Imagetype','imagetype_id');
		}

		public function scopeOfType($query, $itype)
		{
			return $query->where('image_type',$itype);
		}

    // public function mainImageURL()
    // {
    //     return $this->image_path . $this->filename;
    // }
    //
    // public function thumbnailImageURL()
    // {
    //     return $this->image_path . 'thumbnails/thumb-' . $this->filename;
    // }
}
