<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use emutoday\Http\Requests;
use emutoday\Mediatype;


class MediatypeController extends Controller
{

		public function __construct(MediaType $mediatype)
		{
				$this->mediatype = $mediatype;
		}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$mediatypes = $this->mediatype->get();

			return view('admin.mediatype.index', compact('mediatypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MediaType $mediatype)
    {

			return view('admin.mediatype.form', compact('mediatype'));
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
		 $this->mediatype->create(
		 $request->all() + ['name'=> $name]
	 );


			// $id = $role->id;
			flash()->success('mediatype has been created.');
			return redirect(route('admin.mediatype.index'));
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
			$mediatype = $this->mediatype->findOrFail($id);
			return view('admin.mediatype.form', compact('mediatype'));
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
			$mediatype = $this->mediatype->findOrFail($id);
			$name = $request->group .'_'.$request->type;
			$mediatype->fill(
			['name'=>$name] + $request->all()
			)->save();

			flash()->success('mediatype has been updated.');
			return redirect(route('admin.mediatype.edit', $mediatype->id));

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
