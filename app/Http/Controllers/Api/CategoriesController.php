<?php

namespace emutoday\Http\Controllers\Api;

use emutoday\Category;
use emutoday\Event;
use Carbon\Carbon;

use emutoday\Emutoday\Transformers\CategoryTransformer;


class CategoriesController extends ApiController
{

  protected $categoryTransformer;

/**
 * [__construct description]
 * @param [type] $categoryTransformer [description]
 */
  function __construct(CategoryTransformer $categoryTransformer)
  {
    $this->categoryTransformer = $categoryTransformer;
  }
    /**
     * Display a listing of the resource.
     * @param null $eventid
     * @return \Illuminate\Http\Response
     */
    public function index($eventid = null)
    {

      $categories = $this->getCategories($eventid);
       return $this->respond([
          'data' => $this->categoryTransformer->transformCollection($categories->all())
       ]);
    }

    public function activeCategories($year = null, $month = null, $day = null)
    {
      $mondifier;
      if ($year == null) {
        $mondifier = "all";
      } else {
        if ($month == null) {
          $mondifier = "Y";
        } else if ($day == null){
          $mondifier = "YM";
        } else {
            $mondifier = "YMD";
        }
      }
      $activateCategories;

      if($mondifier == "all"){
        $cdate_start = Carbon::now()->startOfDay();
        $activateCategories = Category::with(['events' => function($query) use ($cdate_start) {
                $query->where('start_date', '>=', $cdate_start)->addSelect('id','title');
              }])->addSelect('id','category','slug')->get();

      } else {
        if  ($mondifier == "Y") {
            $cdate_start = Carbon::create($year, 1, 1)->startOfDay();
            $cdate_end =  Carbon::create($year, 12, 31)->endOfDay();
          } else if ($mondifier == "YM") {
              $cdate_start = Carbon::create($year, $month, 1)->startOfDay();
              $cdate_daysInMonth = $cdate_start->daysInMonth;
              $cdate_end =  Carbon::create($year, $month, $cdate_daysInMonth)->endOfDay();
          } else {
            $cdate_start = Carbon::create($year, $month, $day)->startOfDay();
            $cdate_end =  Carbon::create($year, $month, $day)->endOfDay();
          }
          $activateCategories = Category::with(['events' => function($query) use ($cdate_start, $cdate_end) {
                  $query->where([
                        ['start_date', '>=', $cdate_start],
                        ['start_date', '<=', $cdate_end]
                      ])->addSelect('id','title');
                }])->addSelect('id','category','slug')->get();
              }

          // $cats = Category::with('events')->afterThisDate(Carbon::now()->subYear())->get();
          return $this->respond($activateCategories);
    }
    /**
     * [getCategories description]
     * @param  [type] $eventid [description]
     * @return [type]          [description]
     */
    private function getCategories($eventid)
    {

      $categories = $eventid ? Event::findOrFail($eventid)->categories: Category::all();
      return $categories;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
