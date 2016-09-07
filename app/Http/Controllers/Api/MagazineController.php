<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Magazine;
use Illuminate\Support\Facades\Input as Input;

use Illuminate\Http\Request;

use emutoday\Emutoday\Transformers\FractalMagazineTransformer;

use League\Fractal\Manager;
use League\Fractal;


class MagazineController extends ApiController
{


    function __construct(Magazine $magazine)
    {
          $this->magazine = $magazine;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                $fractal = new Manager();

        $magazines = Magazine::all();

                $resource = new Fractal\Resource\Collection($magazines->all(), new FractalMagazineTransformer);
                    // Turn all of that into a JSON string
                    return $fractal->createData($resource)->toJson();
        // return $this->respond([
        //     'data' => $this->storyTransformer->transformCollection($storys->all())
        // ]);
    }
        // public function index()
        // {
        //
        //
        // 		$storys = Story::all();
        //
        // 		return $this->respond([
        // 				'data' => $this->storyTransformer->transformCollection($storys->all())
        // 		]);
        // }

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
     * @param  \Illuminate\Http\Request  $request Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a story');
        // if ( ! $request->input('title') or ! $request->input('body'))
        // {
        //     return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a story');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function saveAs(Request $request, $id)
    {
            $magazine = Magazine::findOrFail($id);


            $storyIDString =  $request->get('story_ids');
            $storyIDarray = explode(",", $storyIDString);
            $storyIDarrayCount = count($storyIDarray);

            $storyIDsForPivotArray;

             for ($x = 0; $x < $storyIDarrayCount; $x++) {
                $namedKey = $storyIDarray[$x];
                 $attributeArray = array();
                 $attributeArray["story_position"] = intval($x);
                 $storyIDsForPivotArray[intval($namedKey)] = $attributeArray;

             }
            $magazine->storys()->sync($storyIDsForPivotArray);
            if($magazine->save()) {
                    return $this->setStatusCode(201)
                                ->respondCreated('Magazine Updated');
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


}
