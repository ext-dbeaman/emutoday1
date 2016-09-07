<?php

namespace emutoday\Http\Controllers\backend;

use Storage;

use emutoday\StoryImage;
use Illuminate\Http\Request;
use emutoday\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class StoryImageController extends Controller
{

    protected $storyImages;
    public function __construct(StoryImage $storyImages)
    {
        $this->storyImages = $storyImages;
        parent::__construct();
    }

    public function index()
    {
        $storyImages = $this->storyImages->paginate(10);
        return view('backend.storyimages.index', compact('storyImages'));
    }

    public function create(StoryImage $storyImage)
    {
        return view('backend.storyimages.form', compact('storyImage'));
    }

    public function store(Requests\StoreUserRequest $request)
    {
        $this->storyImages->create($request->only('image_type'));
        //return redirect(route('backend.users.index'))->with('status', 'User has been created.');
    }


    public function update(Requests\StoryImage_StoreRequest $request,$id)
    {
       //create new instance of model to save from form
       $storyImage = $this->storyImages->findOrFail($id);
       $storyImage->is_active = $request->get('is_active');
       $storyImage->is_featured = $request->get('is_featured');
       $this->formatCheckboxValue($storyImage);
       $storyImage->caption = $request->get('caption');
       $storyImage->teaser = $request->get('teaser');
       $storyImage->moretext = $request->get('moretext');

/*
       $storyImage = new StoryImage([
           'image_name'        => $request->get('image_name'),
           'image_extension'   => $request->file('image')->getClientOriginalExtension(),
           'is_active'         => $request->get('is_active'),
           'is_featured'       => $request->get('is_featured'),
           'caption'           => $request->get('caption'),
           'teaser'            => $request->get('teaser'),
           'moretext'          => $request->get('moretext')

       ]);
*/
       //define the image paths

       $destinationFolder = '/imgs/story/';


       //assign the image paths to new model, so we can save them to DB

       $storyImage->image_path = $destinationFolder;


       // format checkbox values and save model

       $this->formatCheckboxValue($storyImage);


       //parts of the image we will need
       if ( ! empty(Input::file('image'))){

       $imgFile = Input::file('image');
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
       $storyImage->image_extension = $imgFileExtension;


       $imgFileName = $storyImage->image_name . '.' . $storyImage->image_extension;


       $image = Image::make($imgFilePath)
        ->save(public_path() . $destinationFolder . $imgFileName)
        ->fit(100)
        ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

    }
     $storyImage->is_active = 1;
        $storyImage->save();

       /*
       $imgPath = public_path('imgs/story');
       $imgFileName = $file->getClientOriginalName();
       $file->move($imgPath, $imgFileName);


       $imageName = $storyImage->image_name;
       $extension = $request->file('image')->getClientOriginalExtension();

       //create instance of image from temp upload
       $image = Image::make($file->getRealPath());
       Storage::disk('public')->put($imageName, $image);

       //save image with thumbnail

       $image->save(public_path() . $destinationFolder . $imageName . '.' . $extension)
           ->resize(60, 60)
           // ->greyscale()
           ->save(public_path() . $destinationThumbnail . 'thumb-' . $imageName . '.' . $extension);
           // Process the uploaded image, add $model->attribute and folder name
*/
      // flash()->success('Story Image Created!');
      $story = $storyImage->story;
      return redirect(route('backend.story.edit', $story->id ))->with('status', 'Story Image has been created.');
      // return redirect()->route('backend/storyimages.show', [$storyImage]);
    }

    public function edit($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);
        return view('backend.storyimages.edit', compact('storyImage'));
    }

    public function zupdate(Requests\StoryImage_UpdateRequest $request, $id)
    {
        $storyImage = $this->storyImages->findOrFail($id);
        $storyImage->is_active = $request->get('is_active');
        $storyImage->is_featured = $request->get('is_featured');
        $this->formatCheckboxValue($storyImage);
        $storyImage->caption = $request->get('caption');
        $storyImage->teaser = $request->get('teaser');
        $storyImage->moretext = $request->get('moretext');



        if ( ! empty(Input::file('image'))){

            $destinationFolder = $storyImage->image_path;

            $imgFile = Input::file('image');
            $imgFilePath = $imgFile->getRealPath();
            $imgFileName = $storyImage->image_name . '.' . $storyImage->image_extension;


            $image = Image::make($imgFilePath)
             ->save(public_path() . $destinationFolder . $imgFileName)
             ->fit(100)
             ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

        }

        $storyImage->save();
        return redirect(route('backend.storyimages.index'))->with('status', 'Story Image has been Updated.');
    //    return view('backend.storyimages.edit', compact('storyImage'));

    }

    public function show($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);
      // $marketingImage = Marketingimage::findOrFail($id);

       return view('backend.storyimages.show', compact('storyImage'));
    }
    public function confirm($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);

        return view('backend.storyimages.confirm', compact('storyImage'));
    }

    public function destroy($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);

        $pathToImageForDelete = public_path() . $storyImage->image_path . $storyImage->image_name . '.' . $storyImage->image_extension;
        File::delete($pathToImageForDelete);

        $pathToImageThumbForDelete = public_path() . $storyImage->image_path . 'thumbnails/' . 'thumb-' . $storyImage->image_name . '.' . $storyImage->image_extension;
        File::delete($pathToImageThumbForDelete);
        /*

        $destinationFolder = '/imgs/story/';
        $thumbPath = $destinationFolder .'thumbnails/';
        Storage::disk('public')->delete(url($destinationFolder .  $storyImage->image_name . '.' . $storyImage->image_extension));

        Storage::disk('public')->delete(url($thumbPath . 'thumb-' .  $storyImage->image_name . '.' . $storyImage->image_extension));
*/
        //File::delete(public_path($storyImage->image_path) . $storyImage->image_name . '.' . $storyImage->image_extension);
        //Storage::delete(public_path($thumbPath). 'thumb-' . $storyImage->image_name . '.' . $storyImage->image_extension);
        $storyImage->delete();

        return redirect(route('backend.storyimages.index'))->with('status', 'Record has been deleted.');
    }
    public function formatCheckboxValue($storyImage)
    {

       $storyImage->is_active = ($storyImage->is_active == null) ? 0 : 1;
       $storyImage->is_featured = ($storyImage->is_featured == null) ? 0 : 1;
    }


}
