<?php

namespace emutoday\Http\Controllers\Admin;


use emutoday\Announcement;
use Illuminate\Http\Request;

use emutoday\Http\Requests;

class AnnouncementController extends Controller
{

    protected $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user = auth()->user();
        $announcements = $this->announcement->newQuery();
        if ($user->hasRole('contributor_1'))
        {
            $announcements = $announcements->where('user_id', $user->id)->get();
            return view('admin.announcement.role.index', compact('announcements'));
        } else {

            $announcements = $this->announcement->get();

            // $announcements->toJson();
            return view('admin.announcement.index', compact('announcements'));
        }
    }
    public function queue(Announcement $announcement) {
        //$announcements = $this->announcement->first();

        // \JavaScript::put([
        //     'records' => $announcements
        // ]);
        // $announcements->toJson();
        //  $announcements->toArray();
        // $announcements->toJson(JSON_HEX_QUOT);

        return view('admin.announcement.queue', compact('announcements'));
    }
    public function appload() {
        $announcements = $this->announcement->first();

        \JavaScript::put([
            'records' => $announcements
        ]);
        // $announcements->toJson();
        //  $announcements->toArray();
        // $announcements->toJson(JSON_HEX_QUOT);

        return view('admin.announcement.app', compact('announcements'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Announcement $announcement)
    {
        return view('admin.announcement.form', compact('announcement'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'announcement' => $request->announcement,
            'submission_date' => \Carbon\Carbon::now(),
            'start_date' => \Carbon\Carbon::parse($request->start_date),
            'end_date' => \Carbon\Carbon::parse($request->end_date),
            'is_approved' => $request->is_approved,
            'priority' => $request->priority
        ];
        $announcement = $this->announcement->create($data);
        flash()->success('Announcement has been created.');
        return redirect(route('admin.announcement.edit', $announcement->id));//->with('status', 'Story has been created.');
    }


    public function confirm($id)
    {
        $announcement = $this->announcement->findOrFail($id);


        return view('admin.announcement.confirm', compact('announcement'));
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
        $announcement = $this->announcement->findOrFail($id);
        if($announcement->submission_date == '0000-00-00' ){
            $announcement->submission_date = \Carbon\Carbon::parse($announcement->created_at);
        }
        return view('admin.announcement.form', compact('announcement'));
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
        $announcement = $this->announcement->findOrFail($id);

        $announcement->title = $request->title;
        $announcement->announcement = $request->announcement;

        $announcement->start_date = \Carbon\Carbon::parse($request->start_date);
        $announcement->end_date = \Carbon\Carbon::parse($request->end_date);
        $announcement->is_promoted = $request->is_promoted;
        $announcement->priority = $request->priority;
        if ($announcement->is_approved == 0 && $request->is_approved == 1 ){
            $announcement->is_approved  = $request->is_approved;
            $announcement->approved_date = \Carbon\Carbon::now();
        }
        $announcement->archieved = $request->archieved;
        $announcement->save();

        //$story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','story_type'))->save();
        flash()->success('Announcement has been updated.');
        return redirect(route('admin.announcement.edit', $announcement->id));
        //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request)
    {
        $announcement = $this->announcement->findOrFail($request->get('id'));
        $announcement->delete();
        flash()->warning('Announcement has been deleted.');
        return redirect(route('admin.announcement.index'));//->with('status', 'Story has been deleted.');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $announcement = $this->announcement->findOrFail($id);
        $announcement->delete();
        flash()->warning('Announcement has been deleted.');
        return redirect(route('admin.announcement.index'));//->with('status', 'Story has been deleted.');
    }
}
