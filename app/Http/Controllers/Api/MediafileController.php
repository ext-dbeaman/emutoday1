<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Mediafile;
use Illuminate\Support\Facades\Input as Input;

use Illuminate\Http\Request;


use League\Fractal\Manager;
use League\Fractal;


class MediafileController extends ApiController
{


    function __construct(Mediafile $mediafile)
    {
          $this->mediafile = $mediafile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $fractal = new Manager();
        // $magazines = Magazine::all();
        // $resource = new Fractal\Resource\Collection($magazines->all(), new FractalMagazineTransformer);
        // // Turn all of that into a JSON string
        // return $fractal->createData($resource)->toJson();

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
     * @param  \Illuminate\Http\Request  $request Request $request
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

 public function addMediafileEvent($id, Request $request)
 {

         $group = 'event';
         $event = $this->event->findOrFail($id);
         //define the image paths
         $destinationFolder = '/imgs/event/';

         $mediafile = new Mediafile();
         //assign the image paths to new model, so we can save them to DB
         $mediafile->path = $destinationFolder;


             //parts of the image we will need
         // if ( ! empty(Input::file('photo'))){
             $imgFile = $request->file('photo');

             // $imgFile = Input::file('photo');
             $imgFilePath = $imgFile->getRealPath();
             $imgFileOriginalExtension = strtolower($imgFile->getClientOriginalExtension());

         switch ($imgFileOriginalExtension) {
                 case 'jpg':
                 case 'jpeg':
                  $imgFileExtension = 'jpg';
                  break;
                  default:
                  $imgFileExtension = $imgFileOriginalExtension;
              }
              $mediafile->name = 'event'. '-' .$event->id;
              $mediafile->ext = $imgFileExtension;

              $imgFileName = $mediafile->name . '.' . $mediafile->ext;



         $image = Image::make($imgFilePath)
          ->save(public_path() . $destinationFolder . $imgFileName);
         //  ->fit(100)
         //  ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

     // 	}
     //
         $mediafile->filename = $imgFileName;
         $mediafile->type = 'small';
         $mediafile->group = $group;
         // $mediafile->caption = $request->input('caption');
         // $mediafile->note = $request->input('note');
         $mediafile->save();
         $event->is_promoted = 1;
         $event->mediaFiles()->save($mediafile);

         return $this->setStatusCode(201)
                     ->respondCreated('Image has been added to Event and Event has been promoted');


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
