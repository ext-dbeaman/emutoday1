<?php

namespace emutoday\Http\Controllers\EmuToday;

use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Announcement;
use Illuminate\Http\Request;
use emutoday\Http\Requests\StoreAnnouncementRequest;

use Carbon\Carbon;
use JavaScript;


class AnnouncementController extends Controller
{
  protected $announcements;

  public function __construct(Announcement $announcement)
  {
      $this->announcement = $announcement;
            $this->middleware('auth', ['except'=>'index']);
  }

  // public function index($id = null)
  public function index($id = null)
  {
      $currentDate = Carbon::now();
      $announcements = $this->announcement->where([
          ['is_approved', 1],
          ['start_date', '<=', $currentDate],
          ['end_date', '>=', $currentDate]
          ])->paginate(8);
      return view('public.announcement.index', compact('announcements', 'id'));

  }
    // public function create(Announcement $announcement)
    // {
    // 	$cdate = Carbon::now();
    // 	$cdate_format = $cdate->format('m-d-Y');
    // 	JavaScript::put([
    // 		'jsis'=> 'hi',
    // 		'currentDate' => $cdate_format
    // 		]);
    // 		if (\Auth::check()) {
  //   // The user is logged in...
  //    	$user = \Auth::user();
    // 	} else {
    // 		// return 'Need to Connect to LDAP';
    // 		return redirect(route('auth.login'));
    // 	}
    //
    // 	$announcements = $user->announcements;//$this->announcement->where('is_approved', '0')->orderBy('start_date', 'dsc')->paginate(4);
    // 	return view('public.announcement.edit', compact('announcement','announcements'));
    // 	// return redirect(route('emu-today.announcement.edit',$announcement->id ));
    // 	// return view('public.announcement.edit', compact('announcement'));
    // }

    public function create(Announcement $announcement)
    {
        $cdate = Carbon::now();
        $cdate_format = $cdate->format('m-d-Y');
        JavaScript::put([
            'jsis'=> 'hi',
            'currentDate' => $cdate_format
            ]);
            if (\Auth::check()) {
    // The user is logged in...
         $user = \Auth::user();
        } else {
            // return 'Need to Connect to LDAP';
            return redirect(route('auth.login'));
        }

        // $announcements = $user->announcements;//$this->announcement->where('is_approved', '0')->orderBy('start_date', 'dsc')->paginate(4);
        $approveditems = $user->announcements()->where('is_approved', '1')->get();;

        $submitteditems = $user->announcements()->where('is_approved', '0')->get();
        // dd($submitteditems);
        return view('public.announcement.form', compact('announcement','approveditems','submitteditems'));


        // return redirect(route('emu-today.announcement.edit',$announcement->id ));
        // return view('public.announcement.edit', compact('announcement'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
             'title' => 'required',
             'announcement' => 'required|max:400',
             'start_date' => 'required|date'
     ]);

        $announcement = new Announcement();

        $announcement->user_id = auth()->user()->id;
        $announcement->title = $request->title;
        $announcement->announcement = $request->announcement;
        $announcement->start_date = Carbon::parse($request->start_date);
        $announcement->end_date = Carbon::parse($request->end_date);
        // $announcement->start_date = $request->start_date;
        // $announcement->end_date = $request->end_date;
        $announcement->save();
        // dd($announcement->id);
        // if ($request->end_date)
        // $announcement = $this->announcement->create($request->only('title', 'announcement', 'start_date', 'end_date'));
        flash()->success('Announcement has been saved and will be sent for approval');
        return redirect(route('emu-today.announcement.edit',$announcement->id ));
    }
    // public function edit($id)
    // {
    // 		JavaScript::put([
    // 			'currentDate' => Carbon::now()
    // 		]);
    // 		if (\Auth::check()) {
    // 	// The user is logged in...
    // 		$user = \Auth::user();
    // 	} else {
    // 		return 'Need to Connect to LDAP';
    // 	}
    //
    // 	$announcements = $user->announcements;
    // 		$announcement = $this->announcement->findOrFail($id);
    //
    // 		// where('is_approved', '0')->orderBy('start_date', 'dsc')->paginate(4);
    // 		return view('public.announcement.edit', compact('announcement','announcements', 'id' ));
    // }

    public function edit($id)
    {
            JavaScript::put([
                'currentDate' => Carbon::now()
            ]);
            if (\Auth::check()) {
        // The user is logged in...
            $user = \Auth::user();
        } else {

            // return 'Need to Connect to LDAP';
            return redirect(route('auth.login'));

        }


        $announcement = $this->announcement->findOrFail($id);
        // $announcements = $user->announcements;//$this->announcement->where('is_approved', '0')->orderBy('start_date', 'dsc')->paginate(4);
        $approveditems = $user->announcements->where('is_approved', '1');
        $submitteditems = $user->announcements->where('is_approved', '0');

        return view('public.announcement.form', compact('announcement','approveditems','submitteditems'));

    }

    public function update(Request $request, $id)
    {
            $this->validate($request, [
                 'title' => 'required',
                 'announcement' => 'required|max:400',
                 'start_date' => 'required|date'
             ]);




             $announcement = $this->announcement->findOrFail($id);
             // $s_date = $request->start_date;
             $announcement->title = $request->title;
             $announcement->announcement = $request->announcement;
             $announcement->start_date = Carbon::parse($request->start_date);
            $announcement->end_date = Carbon::parse($request->end_date);
             $announcement->save();
             // dd($announcement->id);
             // if ($request->end_date)
             // $announcement = $this->announcement->create($request->only('title', 'announcement', 'start_date', 'end_date'));
             flash()->success('Announcement has been updated and will be sent for approval');
             return redirect(route('emu-today.announcement.edit',$announcement->id ));
    }
}
