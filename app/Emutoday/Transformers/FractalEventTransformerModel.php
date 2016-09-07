<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Event;
use League\Fractal;
use Carbon\Carbon;

class FractalEventTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Event $event)
    {
        return [
            'id'      => (int) $event->id,
            'title'    =>  $event->title,
            'description' => $event->description,
            'submission_date' => is_null($event->submission_date) ? null: $event->submission_date->toDateString(),
            'is_approved' => $event->is_approved,
            'approved_date' => is_null($event->approved_date) ?null :  $event->approved_date->toDateString(),
            'priority' =>  $event->priority,
            'is_promoted' => $event->is_promoted,
            'is_featured' => $event->is_featured,
            'start_date'   => is_null($event->start_date)?null:$event->start_date->toDateString(),
            'start_time' => $event->start_time,
            'end_date'   => is_null($event->end_date) ?null: $event->end_date->toDateString(),
            'end_time' => $event->end_time,
            'is_canceled' => $event->is_canceled,
            'eventimage' => ($event->mediafile_id > 0)?$event->mediaFile->filename: null


        ];
    }
}
