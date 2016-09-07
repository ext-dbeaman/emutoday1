<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Event;
use emutoday\Emutoday\Transformers\EventTransformer;

use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends ApiController
{
  /**
   * @var emutoday\Emutoday\Transformers\EventTransformer
   */
  protected $eventTransformer;

  function __construct(EventTransformer $eventTransformer)
  {
      $this->eventTransformer = $eventTransformer;
    //  $this->beforeFilter('auth.basic', ['on' => 'post']);
  }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // Current Issues:
      // 1. to many - must paginate
      // 2. Now way to attach metadata
      // 3. Linking db structurte to the API Output.. need to hide some data
      // 4. No error Checking

      $events = Event::all();

      return $this->respond([
          'data' => $this->eventTransformer->transformCollection($events->all())
      ]);
        //return Event::latest()->get();
    }


    /**
     * [Creates event list when a date is selected]
     * route calendar/events/{year?}/{month?}/{day?}
     *   Route::get('calendar/events/{year?}/{month?}/{day?}','Api\EventsController@eventsByDay');
     * @param  [type] $year  [description]
     * @param  [type] $month [description]
     * @param  [type] $day   [description]
     * @return [type]        [description]
     */
    public function eventsByDay($year = null, $month = null, $day = null)
    {
      $mondifier;
      if ($year == null) {
        $mondifier = "all";
      } else {
        if ($month == null) {
          $mondifier = "Y";
        } else {
          if ($day == null) {
              $mondifier = "YM";
          } else {
            $mondifier = "YMD";
          }
        }

      }

      if ($mondifier == 'YMD') {
        // $variations = Variation::where('created_at', '<' , $valuation->updated_at->toDateTimeString())->get();

        $cdate_start = Carbon::create($year,$month,$day)->startOfDay();
        $cdate_end = Carbon::create($year,$month,$day)->addDays(7)->endOfDay();
      //  dd($cdatePlusOne);


      } else {
        $cdate_start = Carbon::now()->startOfDay();
        $cdate_end = Carbon::now()->addDays(7)->endOfDay();
      }

      $eventlist = Event::where([
        ['start_date', '>=' , $cdate_start],
        ['start_date', '<=', $cdate_end]
        ])->orderBy('start_date')->get();

      $groupedByDay =  $eventlist->groupBy(function ($date){
    return Carbon::parse($date->start_date)->format('Y-n-j');                // return Carbon::parse($date->start_date)->timestamp;
              });
              // dd($groupedByDay);
        $yearVar = $cdate_start->year;
        $monthVarWord = $cdate_start->format('F');
        $monthVar =  $cdate_start->month;
        $dayVar = $cdate_start->day;
        $firstDate = $cdate_start->format('l, F j');
        $lastDate = $cdate_end->format('l, F j');

        return [ 'groupedByDay' => $groupedByDay,
                            'yearVar'=> $yearVar,
                            'monthVar'=> $monthVar,
                            'monthVarWord'=> $monthVarWord,
                            'dayVar' => $dayVar,
                            'firstDate' => $firstDate,
                            'lastDate' => $lastDate

                          ];
    }


    public function eventsByDate($year = null, $month = null, $day = null)
    {
      $modifier;
      if ($year == null) {
        $modifier = "all";
      } else {
        if ($month == null) {
          $modifier = "Y";
        } else {
          if ($day == null) {
              $modifier = "YM";
          } else {
            $modifier = "YMD";
          }
        }

      }

      // dd($mondifier);


      $cdate = Carbon::now()->subYear();
      $cdate_first = $cdate->firstOfMonth();


      $yearVar =  $cdate->year;
      $monthVar= $cdate->month;
      $monthVarWord = $cdate->format('F');
      $dayInMonth = $cdate->day;
      $monthArray = collect();
      $cd_dayMonthStarts = $cdate->firstOfMonth()->dayOfWeek;
      $cd_daysInMonth = $cdate->daysInMonth;

      $cdate_monthstart = Carbon::create($yearVar, $monthVar, 1, 12);

      $cdate_monthend = Carbon::create($yearVar, $monthVar, $cd_daysInMonth, 12);

      $eventlist = Event::select('id','title', 'start_date', 'end_date')->where([
        ['start_date', '>', $cdate_monthstart],
        ['start_date', '<', $cdate_monthend]
        ])->get();


        $eventlistcount = $eventlist->count();

        $grouped = Event::select('id','title', 'start_date', 'end_date')
                  ->where([
                      ['start_date', '>', $cdate_monthstart],
                      ['start_date', '<', $cdate_monthend]
                      ])->orderBy('start_date', 'asc')->get();

        $groupedByDay =  $grouped->groupBy(function ($date){
                return Carbon::parse($date->start_date)->format('j');
              });




        $keyed = $eventlist->keyBy(function ($item) {
          return Carbon::parse($item['start_date'])->day;
        });
        $uniqueByDay = $keyed->keys();
        $calDaysArray = collect();
      $dayCounter = 0;
      while ($dayCounter < $cd_dayMonthStarts) {
        $dayObject = collect(['day' => 'x'.$dayCounter , 'hasevents'=> 'no']);
        $calDaysArray->push($dayObject);

        //  = array_add($monthArray,$dayCounter, $dayObject);
        $dayCounter++;
      }

      for ($x = 1; $x <= $cd_daysInMonth; $x++){
        $hasevent = $uniqueByDay->contains($x)?'yes':'no';
        $dayObject = collect(['day' => $x, 'hasevents'=> $hasevent]);
        $calDaysArray->push($dayObject);

        // $monthArray = array_add($monthArray,$dayCounter, $dayObject);
        $dayCounter++;
      }

      $totalDaysInArray = count($calDaysArray);

      return [ 'groupedByDay' => $groupedByDay,
                          'elist2' => $eventlist,
                          'eachItems' => $eventlistcount,
                          'uniqueByDay'=> $uniqueByDay,
                          'yearVar'=> $yearVar,
                          'monthVar'=> $monthVar,
                          'monthVarWord'=> $monthVarWord,
                          'monthArray'=> $calDaysArray,
                          'dayInMonth' => $dayInMonth];
    //  $carbondate = new Carbon();
      // if ($mondifier == 'all') {
      //     $events = Event::all();
      //   } else {
        //   $year = 2016;
        //
        //   $carbondatestart = Carbon::create($year,1,1,12);
        //
        //   $carbondateend = Carbon::create($year,1,1,12)->addYear();
        //     $events = Event::where([
        //           ['start_date', '>', $carbondatestart],
        //           ['start_date', '<', $carbondateend],
        //         ])->get();
        // // }
        //
        //   return $this->respond($events);
    }

    /**
     * creates the Calendar Widget on public.event.index
     * Route::get('calendar/month/{year?}/{month?}/{day?}','Api\EventsController@eventsInMonth');
     * route calendar/month/{year?}/{month?}
     * @param  [type] $year  [year to view]
     * @param  [type] $month [month to view]
     * @return [type]        [json encode variables for consumption by vuejs]
     */
    public function eventsInMonth($year = null, $month = null, $day = null)
    {
      $currentDate;
      $selectedDate;
      $cdate_start;
      $cdate_end;
      if ($year == null) {
        $cdate_start = Carbon::now()->startOfMonth();
        $cdate_end = Carbon::now()->endOfMonth();
        $selectedDate = Carbon::now();
      } else {
        if ($month == null) {
            $modifier = "Y";
            $currentMonth = Carbon::now()->month;
            $currentDay = Carbon::now()->day;
            $selectedDate = Carbon::create($year, $currentMonth, $currentDay);
            $cdate_start = Carbon::create($year, $currentMonth, $currentDay)->startOfMonth();
            $cdate_end =  Carbon::create($year, $currentMonth, 1)->endOfMonth();
        } else {
            if ($day == null ){
              $currentDay = Carbon::now()->day;
              $selectedDate = Carbon::create($year, $month, $currentDay );
              $cdate_start = Carbon::create($year, $month, $currentDay)->startOfMonth();
              $cdate_end =  Carbon::create($year, $month, 1)->endOfMonth();
            } else {
              $selectedDate = Carbon::create($year, $month, $day );
              $cdate_start = Carbon::create($year, $month, $day)->startOfMonth();
              $cdate_end =  Carbon::create($year, $month, 1)->endOfMonth();
            }

        }

      }
      // $cdate_start;
      // $cdate_end;
      // if ($modifier == "C") {
      //     $cdate_start = Carbon::now()->startOfDay();
      //     $cdate_end = Carbon::now()->endOfMonth();
      // } else if ($modifier == "Y"){
      //     $currentMonth = Carbon::now()->month;
      //   $cdate_start = Carbon::create($year, $currentMonth, 1)->startOfMonth();
      //   $cdate_end =  Carbon::create($year, $currentMonth, 1)->endOfMonth();
      // } else {
      //   $cdate_start = Carbon::create($year, $month, 1)->startOfMonth();
      //   $cdate_end =  Carbon::create($year, $month, 1)->endOfMonth();
      // }


      $selectedYear = $selectedDate->year;
      $selectedMonth = $selectedDate->month;
      $selectedMonthWord = $selectedDate->format('F');
      $selectedDay = $selectedDate->day;

      $currentDate = Carbon::now();
      $currentYear = $currentDate->year;
      $currentMonth = $currentDate->month;
      $currentMonthWord = $currentDate->format('F');
      $currentDay = $currentDate->day;

      $yearVar =  $currentDate->year;
      $monthVar = $currentDate->format('F');
      $monthVarUnit = $currentDate->month;
      $dayInMonth = $currentDate->day;
      $monthArray = collect();

      $selectedMonth_StartOnDay =  $cdate_start->firstOfMonth()->dayOfWeek;
      $selectedMonth_daysInMonth = $cdate_start->daysInMonth;

    //  $cd_dayMonthStarts = $cdate_start->firstOfMonth()->dayOfWeek;
  //    $cd_daysInMonth = $cdate_start->daysInMonth;
      //
      // $cdate_monthstart = Carbon::create($yearVar, $cdate->month, 1, 12);
      // $cdate_monthend = Carbon::create($yearVar, $cdate->month, $cd_daysInMonth, 12);

      $eventsInMonth = Event::select('id', 'start_date', 'end_date')->where([
        ['start_date', '>', $cdate_start],
        ['start_date', '<', $cdate_end]
        ])->get();

        $keyed = $eventsInMonth->keyBy(function ($item) {
          return Carbon::parse($item['start_date'])->day;
        });
        $uniqueByDay = $keyed->keys();


        $eventlistcount = $eventsInMonth->count();
        $calDaysArray = collect();
      $dayCounter = 0;
      while ($dayCounter < $selectedMonth_StartOnDay) {
        $dayObject = collect(['day' => 'x'.$dayCounter , 'hasevents'=> 'no-events']);
        $calDaysArray->push($dayObject);
        $dayCounter++;
      }
      // dd($uniqueByDay);

      for ($x = 1; $x <= $selectedMonth_daysInMonth; $x++){
        $hasevent = $uniqueByDay->contains($x)?'yes-events':'no-events';
        $dayObject = collect(['day' => $x, 'hasevents'=> $hasevent]);
        $calDaysArray->push($dayObject);

        // $monthArray = array_add($monthArray,$dayCounter, $dayObject);
        $dayCounter++;
      }
// dd($calDaysArray);
      $totalDaysInArray = count($calDaysArray);


      return ['uniqueByDay'        => $uniqueByDay,
        'calDaysArray'        => $calDaysArray,
              'selectedYear'        => $selectedYear,
              'selectedMonth'       => $selectedMonth,
              'selectedMonthWord'   => $selectedMonthWord,
              'selectedDay'         => $selectedDay,
              'currentYear'        => $currentYear,
              'currentMonth'       => $currentMonth,
              'currentMonthWord'   => $currentMonthWord,
              'currentDay'         => $currentDay,
            ];

          //     'yearVar' => $yearVar,
          //     'monthVar' => $monthVar,
          //       'monthVarUnit' => $monthVarUnit,
          //   'dayInMonth' => $dayInMonth,
          // 'currentDate'=> $currentDate];
          }


    public function byDate(Request $request)
    {
      return $request->all();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //return some kind of Response
      // 400  'bad request'
      // 403 Forbidden
      //
      // 422 'unprocessable entity'
      //
    //  if (! Input::get('title') or ! Input::get('location'))


    $validation = \Validator::make( $request->all(), [
                                  'title'           => 'required',
                                  'location'        => 'required',
                                  'start_date'      => 'required|date',
                                  'end_date'        => 'required|date',
                                  'categories'      => 'required',
                                  'description'     => 'required',
                                  'contact_person'  => 'required',
                                  'contact_phone'  => 'required',
                                  'contact_email'  => 'required|email'


                               ]);

     if( $validation->fails() )
     {
      //  return $this->setStatusCode(422)
      //              ->respondWithError($validation->errors()->getMessages());
       //
       return json_encode([
               'errors' => $validation->errors()->getMessages(),
               'code' => 422
            ]);
     }

    // if (! $request->input('title') or ! $request->input('location'))
    //   {
    //       return $this->setStatusCode(422)
    //                   ->respondWithError('Parameters failed validation for an event');
    //   }

      // Event::create(Input::all());
      Event::create($request->all());
      return $this->setStatusCode(201)->respondCreated('Event successfully created.');
      // $validation = \Illuminate\Support\Facades\Validator::make(
      //   $request->only('title','location','start_date', 'start_time'),[
      //    'title' => 'required|max:100',
      //    'location'       => 'required',
      //    'start_date'     => 'required',
      //    'start_time'     => 'required',
      //   ]);


        // if($validation->passes())
        // {
        //   $event = new Event;
    
        //   $event->short_title     = $request->get('short_title');
        //   $event->location        = $request->get('location');
        //   $event->start_date      = \Carbon\Carbon::parse($request->get(start_date));
        //   $event->start_time     = \Carbon\Carbon::parse($request->get(start_time));
        //
        //   if($event->save()) {
        //     return response()->json([
        //             'success' => true,
        //             'message' => 'record updated'
        //         ], 200);
        //   }
        // }
        //
        // $errors = $validation->errors();
        // $errors =  json_decode($errors);
        //
        // return response()->json([
        //   'success' => false,
        //   'message' => $errors
        // ], 422);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $event = Event::find($id);

      if (! $event)
      {
          return $this->respondNotFound('Event Does Not Exist!');
      }

      return $this->respond([
          'data' => $this->eventTransformer->transform($event)

      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
