<?php

namespace emutoday\Presenters;

use Laracasts\Presenter\Presenter;

class StoryImagePresenter extends Presenter
{
    protected $story;

    protected $thumbnailPath = 'thumbnails/thumb-';

    // public function fullImagePath()
    // {
    //     return $this->image_path . $this->filename;
    // }
    // public function thumbnailImagePath()
    // {
    //     return $this->image_path . $this->thumbnailPath . $this->filename;
    // }

    public function attachedToStoryId(){
        $story = $this->story;
        return  $this->$story->id;
    }

    public function mainImageURL()
    {
        return $this->image_path . $this->filename;
    }

    public function thumbnailImageURL()
    {
        return $this->image_path . 'thumbnails/thumb-' . $this->filename;
    }
}
