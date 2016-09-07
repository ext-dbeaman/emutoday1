<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use emutoday\Http\Requests;
use emutoday\Imagetype;


class ImagetypeController extends Controller
{

		public function __construct(Imagetype $imagetype)
		{
				$this->imagetype = $imagetype;
		}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$imagetypes = $this->imagetype->get();

			return view('admin.imagetype.index', compact('imagetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Imagetype $imagetype)
    {

			return view('admin.imagetype.form', compact('imagetype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			$this->validate($request, [
				 'group' => 'required|alpha_dash',
				 'type' => 'required|alpha_dash',
				 'width' => 'integer',
				 'height' => 'integer'
		 ]);
		 $name = $request->group . '_' . $request->type;
		 $this->imagetype->create(
		 $request->all() + ['name'=> $name]
	 );


			// $id = $role->id;
			flash()->success('imagetype has been created.');
			return redirect(route('admin.imagetype.index'));
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
			$imagetype = $this->imagetype->findOrFail($id);
			return view('admin.imagetype.form', compact('imagetype'));
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
			$imagetype = $this->imagetype->findOrFail($id);
			$name = $request->group .'_'.$request->type;
			$imagetype->fill(
			['name'=>$name] + $request->all()
			)->save();

			flash()->success('imagetype has been updated.');
			return redirect(route('admin.imagetype.edit', $imagetype->id));

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
