<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use emutoday\Http\Requests;
use emutoday\Bugz;

class BugzController extends Controller
{
	public function __construct(Bugz $bugz)
	{
			$this->bugz = $bugz;

	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$user = auth()->user();
			$bugzs = $this->bugz->get();

			return view('admin.bugz.index', compact('bugzs'));

    }

		public function appload() {

			$user = auth()->user();
			$bugzs = $this->bugz->get();

				\JavaScript::put([
						'records' => $bugzs
				]);


				return view('admin.bugz.app', compact('bugzs'));
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
				 $bugz = $this->bugz->create(
				 [ 'user_id' => auth()->user()->id ] + $request->all()//('template', 'uri', 'start_date', 'end_date')
 		 			);
				 flash()->success('Bugz has been created.');
				 return redirect(route('admin.bugz.edit', $bugz->id));//->with('status', 'Story has been created.');
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
        $bugz = $this->bugz->findOrFail($id);
				$bugzs = $this->bugz->where('confirmed', 0)->get();

				return view('admin.bugz.form', compact('bugz', 'bugzs'));
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
          $bugz = $this->bugz->findOrFail($id);
					$bugz->fill($request->only('type', 'screen', 'notes', 'priority', 'note_reply','complete','confirmed'))->save();
					flash()->success('Bugz has been updated.');
					return redirect(route('admin.bugz.edit', $bugz->id));//
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
