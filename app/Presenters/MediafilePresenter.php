<?php

namespace emutoday\Presenters;

use Laracasts\Presenter\Presenter;

class MediafilePresenter extends Presenter
{
    protected $mediafile;

    protected $thumbnailPath = 'thumbnails/thumb-';

    // public function fullImagePath()
    // {
    //     return $this->image_path . $this->filename;
    // }
    // public function thumbnailImagePath()
    // {
    //     return $this->image_path . $this->thumbnailPath . $this->filename;
    // }

    public function attachedToUserId(){
        $user = $this->user;
        return  $this->$user->id;
    }

    public function mainMediafileURL()
    {
        return $this->path . $this->name . '.' . $this->ext;
    }

    public function thumbnailMediafileURL()
    {
        return $this->path . 'thumbnails/thumb-' . $this->name . '.' . $this->ext;
    }
}
