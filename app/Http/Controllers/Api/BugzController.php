<?php

namespace emutoday\Http\Controllers\Api;

use emutoday\Bugz;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;

use emutoday\Emutoday\Transformers\FractalBugzTransformerModel;
use League\Fractal\Manager;
use League\Fractal;

class BugzController extends ApiController
{
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

			$bugz = new Bugz;
			$bugz->user_id       	=  $request->get('user_id');
			$bugz->type           	= $request->get('type');
			$bugz->screen      		= $request->get('screen');
			$bugz->notes           	= $request->get('notes');
			$bugz->priority      		= $request->get('priority');
			if($bugz->save()) {
				 return response()->json([
				         'success' => true
				     ], 201);
					 }
				 }

					// return $this->setStatusCode(201)
					// 					->respondCreated('bug Made');
					//
					// 				 }


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
    public function updateItem(Request $request, $id)
    {
			$bugz = Bugz::findOrFail($id);
			$bugz->type = $request->get('type');
			$bugz->priority = $request->get('priority');
			$bugz->notes 			= $request->get('notes');
			$bugz->note_reply 			= $request->get('note_reply');
				$bugz->complete 	= $request->get('complete');
			if($bugz->save()) {
					return $this->setStatusCode(201)
								->respondCreated('Announcement successfully patched');
							}
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

		public function listall()
		{

				$fractal = new Manager();

				$bugzs = Bugz::all();

				$resource = new Fractal\Resource\Collection($bugzs->all(), new FractalBugzTransformerModel);
					// Turn all of that into a JSON string
					return $fractal->createData($resource)->toArray();
				// return $this->respond([
				//     'data' => $this->storyTransformer->transformCollection($storys->all())
				// ]);
		}

		// public function approvedItems()
		// {
		//
		// 		$fractal = new Manager();
		//
		// 			 $bugzs = Bugz::where('is_approved', 1)->get();
		// 			 $resource = new Fractal\Resource\Collection($bugzs->all(), new FractalAnnouncementTransformerModel);
		// 			// Turn all of that into a JSON string
		// 			return $fractal->createData($resource)->toArray();
		// 		// return $this->respond([
		// 		//     'data' => $this->storyTransformer->transformCollection($storys->all())
		// 		// ]);
		// }
		public function incompleteItems()
		{

				$fractal = new Manager();

				$bugzs = Bugz::where('complete', 0)->get();
				$resource = new Fractal\Resource\Collection($bugzs->all(), new FractalBugzTransformerModel);
					// Turn all of that into a JSON string
					return $fractal->createData($resource)->toArray();
				// return $this->respond([
				//     'data' => $this->storyTransformer->transformCollection($storys->all())
				// ]);
		}
}
