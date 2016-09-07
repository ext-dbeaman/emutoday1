<?php

namespace emutoday;



use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Laracasts\Presenter\PresentableTrait;

class Page extends Model
{
    use PresentableTrait;
    protected $presenter = 'emutoday\Presenters\PagePresenter';

    protected $fillable = ['template', 'uri', 'start_date', 'end_date', 'user_id'];
    protected $dates = ['end_date', 'start_date'];

    public function storys(){
        return $this->belongsToMany('emutoday\Story')
            ->withPivot('page_position', 'note')
            ->withTimestamps();
    }

    public function storyImages()
    {
        return $this->hasManyThrough('emutoday\StoryImage', 'emutoday\Story');
    }


    // public function getStartDate($date){
    //     return Carbon::parse($date);
    // }
    // public function setStartDate($value){
    //     $this->attributes['start_date'] = Carbon::createFromFormat('mm-dd-yyyy hh:ii:ss');
    // }
    // public function getEndDate($date){
    //     return Carbon::parse($date);
    // }
    // public function setEndDateAttribute($value){
    //     $this->attributes['end_date'] = Carbon::createFromFormat('mm-dd-yyyy hh:ii:ss');
    // }
}
