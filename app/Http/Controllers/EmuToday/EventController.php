<?php

namespace emutoday\Http\Controllers\EmuToday;

use emutoday\Event;

use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;


use Carbon\Carbon;
use JavaScript;

class EventController extends Controller
{

        public function __construct(Event $event)
        {
                $this->event = $event;
                $this->middleware('auth', ['except'=>'index']);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
            // $cats = \emutoday\Category::lists('category', 'id');
            // $categories = $event->categories;
            // dd($categories);
                    // $this->event = $event;
                    if (\Auth::check()) {
                // The user is logged in...
                    $user = \Auth::user();
                } else {
                    return redirect(route('auth.login'));
                }
                // $event = $this->event->findOrFail($id);
                // $users = emutoday\Event::with(['posts' => function ($query) {
                //     $query->where('title', 'like', '%first%');
                //
                // }])->get();

                $approveditems = $this->event->where([
                    ['user_id', $user->id],
                    ['is_approved',1]
                    ])->get();
                    $submitteditems = $this->event->where([
                        ['user_id', $user->id],
                        ['is_approved',0]
                        ])->get();

                return view('public.event.form', compact('event', 'approveditems','submitteditems'));

                // return redirect(route('emutoday_event_edit'));
                // $approveditems = $user->events->where('approved', '1');
                // $submitteditems = $user->events->where('approved', '0');
                //
                // return view('public.event.form', compact('event', 'approveditems','submitteditems'));
            // return view('public.event.form', compact('event'));


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
    public function edit($id = null)
    {
            if (\Auth::check()) {
        // The user is logged in...
            $user = \Auth::user();
        } else {
            return redirect(route('auth.login'));
        }
        if ($id){
                $event = $this->event->findOrFail($id);

            } else {
                $event = new Event();

            }



            $approveditems = $this->event->where([
                ['user_id', $user->id],
                ['is_approved',1]
                ])->get();
                $submitteditems = $this->event->where([
                    ['user_id', $user->id],
                    ['is_approved',0]
                    ])->get();

              JavaScript::put([
                    'jsis' => 'hi',

                ]);
            return view('public.event.form', compact('event', 'approveditems','submitteditems'));

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
            $taglistRequest = $request->input('tag_list') == null ? [] : $request->input('tag_list');
            $story->tags()->sync($taglistRequest);

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

        // private function syncCategories(Event $event, array $cats)
        // {
        // 	$event->categories()->sync($cats)
        // 	// $story->tags()->sync($tags);
        //
        // }
}
