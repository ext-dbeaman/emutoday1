<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Event;
use emutoday\Category;

class EventController extends Controller
{

  protected $events;

  public function __construct(Event $events)
  {
    $this->events = $events;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $events = $this->events->orderBy('start_date', 'desc')->paginate(10);

      return view('admin.event.index', compact('events'));
    }
    public function queue(Event $event)
    {
    //   $events = $this->events->orderBy('start_date', 'desc')->paginate(10);

      return view('admin.event.queue', compact('event'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
      //  $categories = \emutoday\Category::lists('category', 'id');
        return view('admin.event.form', compact('event', 'categories'));
        // return view('admin.event.create', compact('event','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreEventRequest $request)
    {
      $data = [
        'user_id' => auth()->user()->id,
        'title' => $request->title,
        'short_title' => $request->short_title,
        'location' => $request->location,
        'start_date' => \Carbon\Carbon::parse($request->start_date),
        'end_date' => \Carbon\Carbon::parse($request->end_date),
        'all_day' => $request->is_approved,
        'no_end_time' => $request->is_promoted,
        'description' => $request->description
    ];
      $event = $this->events->create($data);
      flash()->success('Event has been created.');
      return redirect(route('admin.event.edit', $event->id));//->with('status', 'Story has been created.');
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
      $event = $this->events->findOrFail($id);
      $categories = \emutoday\Category::lists('category', 'id');

      return view('admin.event.form', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateEventRequest $request, $id)
    {
        //
    }

    /**
     * Confirm the deletion of the event
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm($id)
    {
        $event = $this->events->findOrFail($id);
        return view('admin.event.confirm', compact('event'));
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
