<?php

namespace emutoday\Http\Controllers\Api;
use emutoday\MiniCalendar;
use emutoday\Event;
use emutoday\Emutoday\Transformers\MiniCalendarTransformer;




class MiniCalendarsController extends ApiController
{
  /**
   * [__construct description]
   * @param [type] $categoryTransformer [description]
   */
    function __construct(MiniCalendarTransformer $miniCalendarTransformer)
    {
      $this->miniCalendarTransformer = $miniCalendarTransformer;
    }

    /**
     * Display a listing of the resource.
     * @param null $eventid
     * @return \Illuminate\Http\Response
     */
    public function index($eventid = null)
    {
      $minicalendars = $this->getMiniCalendars($eventid);
       return $this->respond([
          'data' => $this->miniCalendarTransformer->transformCollection($minicalendars->all())
       ]);
    }

    /**
     * [getCategories description]
     * @param  [type] $eventid [description]
     * @return [type]          [description]
     */
    private function getMiniCalendars($eventid)
    {

      $minicalendars = $eventid ? Event::findOrFail($eventid)->minicalendars: MiniCalendar::all();
      return $minicalendars;
    }


}
