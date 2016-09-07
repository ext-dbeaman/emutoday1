<?php

namespace emutoday\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class PagePresenter extends Presenter
{

    public function pageStatus()
    {
        $status = '';
        if($this->storys){
            if ($this->storys->count() >= $this->template_elements){
                $status = 'complete';
            } else if($this->storys->count() < $this->template_elements) {
                $status = 'incomplete';
            } else {
                $status =  'incomplete';
            }

        } else {
            $status = 'incomplete';
        }

        return $status;


    }
    public function pageScheduleStatus()
    {
        if ($this->start_date && $this->start_date->isFuture()) {
            return 'warning';
        } elseif ($this->start_date && $this->start_date->isPast() && $this->end_date && $this->end_date->isFuture()) {
            return 'danger';
        } elseif ($this->end_date && $this->end_date->isPast()) {
            return 'active';
        } else {
            return 'isproblem';
        }

    }
    public function pageLiveIn()
    {
        if ($this->start_date && $this->start_date->isFuture()) {
            return 'Starts in '. $this->start_date->diffForHumans(Carbon::now(),true);
        } elseif ($this->start_date && $this->start_date->isPast() && $this->end_date && $this->end_date->isFuture()) {
            return 'Ends in '. $this->end_date->diffForHumans(Carbon::now(),true);
        } elseif ($this->end_date && $this->end_date->isPast()) {
            return 'Ended ' .$this->end_date->diffForHumans();
        } else {
            return 'isproblem';
        }

    }

    public function prettyStartDate()
    {
        return $this->start_date->format('m-d-Y');
    }
    public function prettyEndDate()
    {
        return $this->end_date->format('m-d-Y');
    }
   //
   // public function __construct()
   // {
   //    $this->markdown = new CommonMarkConverter();
   //
   //    parent::__construct($object);
   //
   // }

   // public function contentHtml()
   // {
   //    return $this->markdown->convertToHtml($this->content);
   //
   // }

   // public function urlWildcard()
   // {
   //    return $this->url.'*';
   //
   // }
   //  public function prettyUri()
   // {
   //     return '/'.ltrim($this->uri, '/');
   // }
   //
   // public function linkToPaddedTitle($link)
   //  {
   //      $padding = str_repeat('&nbsp;', $this->depth * 4);
   //
   //      return $padding.link_to($link, $this->title);
   //  }
   //  public function paddedTitle()
   //   {
   //       return str_repeat('&nbsp;', $this->depth * 4).$this->title;
   //
   //   }

}
