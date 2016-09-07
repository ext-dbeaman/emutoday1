<?php

namespace emutoday\Http\Controllers\Admin;

use emutoday\Story;
use emutoday\StoryImage;
use emutoday\Tag;
use emutoday\User;
use emutoday\Imagetype;
use emutoday\StoryType;
use emutoday\Emutoday\Transformers\FractalStoryTransformer;
use emutoday\Emutoday\Transformers\FractalStoryExtraTransformer;
use emutoday\Emutoday\Transformers\StoryTransformer;

use League\Fractal\Manager;
use League\Fractal;
use Illuminate\Http\Request;
use emutoday\Http\Requests;
use DB;
use JavaScript;

class StoryTypeController extends Controller
{
    private $story;

    public function __construct(Story $story, StoryType $storyType, StoryTransformer $storyTransformer)
    {
        $this->story = $story;
        $this->storyType = $storyType;
        $this->storyTransformer = $storyTransformer;
    }

    public function list($stype)
    {
        //$storys = $this->story->where('story_type', $stype)->get();
        $stypelist = \emutoday\StoryType::where('level', 1)->pluck('name','shortname');
        $stypes = $stype;
        \JavaScript::put([
            'stype' => $stype,
            'storyTypeList' => $stypelist
        ]);
        return view('admin.story.index', compact('stype', 'stypes'));
        // return view('admin.story.index', compact('stype'));

    }


    /**
    * [storyTypeSetUp description]
    * @param  [type] $stype [description]
    * @return [type]        [description]
    */
    public function storyTypeSetUp($stype)
    {
        $sroute = 'story';
        $story = new Story;
        $stypelist = \emutoday\StoryType::where('level', 1)->pluck('name','shortname')->all();
        //$stypelist = \emutoday\StoryType::all();
        $stypes  = collect(\emutoday\StoryType::select('name','shortname')->get());
    //    $stypelist2 = collect(\emutoday\StoryType::select('name','shortname')->get())->toJson();

        // dd($stypelist,$stypelist1);
        $user = \Auth::user();
        if ($user->hasRole('contributor_1')){
            // dd($user->id);
            $stypelist = 'news';
            $stype = 'news';
            $stypes = 'news';
        } else {
            if($stype == 'new') {
                $stypelist =  $stypelist;
                $stypes = $stypes;
            } else {
                $stypes = $stype;
                $stypelist =  $stypelist;
            }

        }
        JavaScript::put([
            'cuser' => $user,
            'stypes' => $stypes,
            'storytype' => $stype,
            'stypelist' => $stypelist
        ]);
        // dd($stypelist,$stypelist1,$stypelist2,$stypelist3);

        return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ));

    }


    /**
    * Route::get('magazine/article/setup', ['as' => 'admin_magazine_article_setup', 'uses' => 'Admin\StoryController@articleSetup']);
    * @return [type]        [Direct route for creating a magazine article]
    */
    public function articleSetup()
    {
        $user = \Auth::user();
        $story = new Story;
        // $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
        $sroute = 'magazine';
        $stypelist = 'article';
        $stype = 'article';
        $stypes = 'article';
        $story->story_type = $stypes;

        JavaScript::put([
            'cuser' => $user,
            'stypes' => $stypes,
            'storytype' => $stype,
            'stypelist' => $stypelist
        ]);
        return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ));

        // return view('admin.story.form', compact('story','sroute','stypes','stypelist'));

    }

    // Route::get('story/{stype}/{story}/edit', ['as' => 'admin_storytype_edit', 'uses' => 'Admin\StoryController@storyTypeEdit']);

    public function storyTypeEdit($stype, Story $story)
    {
        $urlprev = \URL::previous();

        if(str_contains($urlprev, 'magazine')) {
            $sroute = 'magazine';
        } else {
            $sroute = 'story';
        }

        $user = \Auth::user();
        //$stypes = $stype;
        $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
        $stypes  = collect(\emutoday\StoryType::select('name','shortname')->get());

        $tags = \emutoday\Tag::lists('name', 'id');

        if ($stype == 'emutoday'){
            $stype = 'story';
        }
        $storyGroup = $story->storyType->group;

        JavaScript::put([
            'story' => $story,
            'stype' => $stype,
            'storytype' => $story->story_type,
            'is_featured' => $story->is_featured,
        ]);
        // $sroute = 'story';
        if ($user->hasRole('contributor_1')){
            // dd($user->id);
            $stypelist = 'news';
            $stype = 'news';
            $stypes = 'news';
        } else {

            // dd($story->storyImages->where('is_active',1)->count());
            $currentRequiredImages = null;
            $currentOtherImages = null;
            $stillNeedTheseImgs = null;

            $imagetypeNames = Imagetype::ofGroup($storyGroup)->get()->keyBy('id');
            // dd($imagetypeNames->count());
            // $requiredImageKeys = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();

            $requiredImageListCollection = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
            $otherImageListCollection = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();

            // List out the  required image types  needed
            $requiredImageList = Imagetype::ofGroup($storyGroup)->isRequired(1)->pluck('type', 'id');
            $requiredImageListArray = $requiredImageList->toArray();

            // List out all the possible other image types
            $otherImageList = Imagetype::ofGroup($storyGroup)->isRequired(0)->pluck('type', 'id');
            $otherImageListArray = $otherImageList->toArray();

            //create array of requireed images to compare with actual iamges
            $requiredImageCollect = Imagetype::ofGroup($storyGroup)->isRequired(1)->pluck('id');//keyBy('id');
            $requiredImageKeyArray = $requiredImageCollect->toArray();

            $currentRequiredImages = $story->storyImages->whereIn('imagetype_id',$requiredImageKeyArray);

            $remainingRequiredImagesNeeded = $requiredImageList->count() - $currentRequiredImages->count();

            // dd($imagetypeNames,$requiredImageList,$requiredImageListArray,$requiredImageCollect,$requiredImageKeyArray);
            $stillNeedTheseImgs = null;

            if($remainingRequiredImagesNeeded > 0) {
                $currentRequiredImagesIdsList = $currentRequiredImages->pluck('imagetype_id');
                $currentRequiredImagesIdsListArray = $currentRequiredImagesIdsList->toArray();

                $stillNeedTheseImgs = $requiredImageListCollection->except($currentRequiredImagesIdsListArray);


                $currentOtherImages = null;

                // dd($stillneedthese);
                // dd('$remainingRequiredImagesNeeded='. $remainingRequiredImagesNeeded);


                return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs'));

            } else {

                $otherImageCollect = Imagetype::ofGroup($storyGroup)->isRequired(0)->pluck('id');//keyBy('id');
                $otherImageKeyArray = $otherImageCollect->toArray();

                $currentOtherImages = $story->storyImages->whereIn('imagetype_id',$otherImageKeyArray);

                $remainingOtherImagesNeeded = $otherImageCollect->count() - $currentOtherImages->count();

                // dd('$remainingOtherImagesNeeded=' . $remainingOtherImagesNeeded);

                if ($remainingOtherImagesNeeded > 0) {
                        $currentOtherImagesIdsList = $currentOtherImages->pluck('imagetype_id');
                        $currentOtherImagesIdsListArray = $currentOtherImagesIdsList->toArray();
                        $stillNeedTheseImgs = $otherImageListCollection->except($currentOtherImagesIdsListArray);

                        return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs'));


                } else {
                    $stillNeedTheseImgs = null;
                    return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs'));

                }

            }

        }
        $currentRequiredImages = null;
        $currentOtherImages = null;
        $stillNeedTheseImgs = null;

        return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs'));
    }


    // public function storyTypePreview($stype, Story $story)
    // {
    //
    //     return redirect()->route('emutoday_preview',['stype'=> $stype, 'id' => $story->id]);
    //
    // }


//     public function store(Requests\StoreStoryRequest $request)
//     {
//         $pubStartDate = $request->start_date;
//         $pubEndDate = $request->end_date;
//         // $pubStartDate = $request->start_date == null ?\Carbon\Carbon::now() : \Carbon\Carbon::parse($request->start_date) ;
//         // $pubEndDate = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);
//
//         $story = $this->story->create(
//
//         ['user_id' => auth()->user()->id] + $request->only('title', 'slug', 'subtitle', 'teaser','content', 'external_link', 'story_type') + ['start_date' => $pubStartDate] + ['end_date' => $pubEndDate ]
//
//     );
//     $storyGroup = $story->storyType->group;
//
//     if($storyGroup != 'news') {
//
//         $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
//         $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();
//         $stypelist = StoryType::where('level', 1)->lists('name','shortname');
//         $stypes = $story->story_type;
//
//         foreach ($requiredImages as $img) {
//             $story->storyImages()->create([
//                 'imagetype_id'=> $img->id,
//                 'group'=> $storyGroup,
//                 'image_type'=> $img->type,
//                 'image_name'=> 'img' . $story->id . '_' . $img->type
//             ]);
//         }
//     }
//     if($story->story_type == 'article'){
//         flash()->success('Article has been created.');
//         return redirect(route('admin_magazine_article_edit', $story->id));
//
//     } else {
//         flash()->success('Story has been created.');
//         return redirect(route('admin.story.edit', $story->id));
//     }
//
//
// }

public function index(){
    $stypes = \emutoday\StoryType::all()->pluck('group','group');
    $stypes = $stypes->prepend('all', 'all');
    $stype = 'all';
    \JavaScript::put([
        'stype' => 'all'
    ]);


    return view('admin.story.index', compact('stype','stypes'));
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create($stype)
{
    $story = new Story;
    $sroute = 'story';
    if ($stype != 'story' ) {
        if ($stype == 'external'){
            return view('admin.story.external', compact('story', 'stype'));
        } else {
            return view('admin.story.create', compact('story', 'stype'));
        }
    } else {
        $stypes = $stype;
        $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');

        return view('admin.story.form', compact('story','sroute', 'stypes','stypelist'));


    }

}
public function imageBrowse(Request $request)
{
    dd($request->all());
    $this->validate($request, [
        'image' => 'required|dimensions:max_width=900,max_height=500|size:3000|'
    ]);
    $CKEditor = Input::get('CKEditor');
    $funcNum = Input::get('CKEditorFuncNum');
    $message = $url = '';
    $uploadDestination = public_path() . '/imgs/uploads/story/';

    if (Input::hasFile('upload')) {
        $file = Input::file('upload');
        if ($file->isValid()) {
            $filename = $file->getClientOriginalName();
            $file->move($uploadDestination, $filename);
            $url = $uploadDestination . $filename;
        } else {
            $message = 'An error occured while uploading the file.';
        }
    } else {
        $message = 'No file uploaded.';
    }
    return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';

}

// Route::post('/upload_image', function() {
public function imageUpload(Request $request)
{


    $file = $request->file('upload');


    $uploadDestination = public_path() . '/imgs/uploads/story/';
    $filename = preg_replace('/\s+/', "", $file->getClientOriginalName());
    $fileName = md5($filename) . "_" . $filename;
    $file->move($uploadDestination, $fileName);
}

// public function queue(Story $story) {
//     $storys = $this->story;
//
//     \JavaScript::put([
//         'records' => $storys
//     ]);
//     return view('admin.story.app', compact('storys'));
// }

public function addImage($id)
{
    $story = $this->story->findOrFail($id);
    $storyImage = $story->addImage('hero');
    flash()->success('New Image Added.');
    return redirect(route('admin.story.edit', $story->id));
}

public function addNewImage($id, Request $request)
{
    $story = $this->story->findOrFail($id);
    $storyGroup = $story->storyType->group;
    $story->storyImages()->create([
        'imagetype_id'=> $request->img_id,
        'group'=> $storyGroup,
        'image_type'=> $request->img_type,
        'image_name'=> 'img' . $story->id . '_' . $request->img_type

    ]);
    if($request->img_type == 'front') {
        $story->is_featured = 1;
        $story->save();
    }
    flash()->success('New Image Added.');
    return redirect(route('admin.story.edit', $story->id));
}
public function promoteStory($id, Request $request)
{
    $story = $this->story->findOrFail($id);
    //return 'working on it' . $story->id;
    //
    $story->story_type = $request->new_story_type;
    $story->save();
    $storyGroup = $story->storyType->group;


    $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
    $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();
    $stypelist = StoryType::where('level', 1)->lists('name','shortname');
    $stypes = $story->story_type;

    foreach ($requiredImages as $img) {
        $story->storyImages()->create([
            'imagetype_id'=> $img->id,
            'group'=> $storyGroup,
            'image_type'=> $img->type,
            'image_name'=> 'img' . $story->id . '_' . $img->type

        ]);
    }


    flash()->success('Story has been Promoted.');

    return redirect(route('admin.story.edit', $story->id));

}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    $story = $this->story->findOrFail($id);
    $stype = $story->story_type;

    if ($stype == 'external') {
        $smallStoryImg = $story->storyImages()->where('image_type', 'small')->first();

        return view('admin.story.previewexternal', compact('story','smallStoryImg'));
    } else if ($stype == 'news') {

        return view('admin.story.preview', compact('story'));
    } else {

        $mainStoryImg = $story->storyImages()->where('image_type', 'story')->first();

        $smallStoryImg = $story->storyImages()->where('image_type', 'small')->first();
        // dd($smallStoryImg);
        return view('admin.story.preview', compact('story','mainStoryImg','smallStoryImg'));
    }


}
public function update(Requests\UpdateStoryRequest $request, $id)
{

    // dd($request->input('tags'));

    $story = $this->story->findOrFail($id);

    $story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','external_link', 'story_type','is_approved', 'is_featured'));
    $story->start_date = \Carbon\Carbon::parse($request->start_date);
    $story->end_date = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);
    $story->save();
    $taglistRequest = $request->input('tag_list') == null ? [] : $request->input('tag_list');
    $story->tags()->sync($taglistRequest);

    $storyGroup = $story->storyGroup->group;
    $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
    $countRequiredImages = $requiredImages->count();


    $currentStoryImages = $story->storyImages()->where('is_active', 1)->get();
    $countCurrentStoryImages = $currentStoryImages->count();

    if($countCurrentStoryImages >= $countRequiredImages){
        $story->is_ready = 1;
        $story->is_promoted = 1;
    } else {
        $story->is_ready = 0;
        $story->is_promoted = 0;
    }
    $story->save();
    flash()->success('Story has been updated.');
    return redirect(route('admin.story.edit', $story->id));
    //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
}

public function destroy($id)
{
    $story = $this->story->findOrFail($id);
    $story->delete();
    flash()->warning('Story has been deleted.');
    return redirect(route('admin.story.index'));//->with('status', 'Story has been deleted.');
}

public function confirm($id)
{
    $story = $this->story->findOrFail($id);
    return view('admin.story.confirm', compact('story'));
}

public function edit($id)
{
    $story = $this->story->findOrFail($id);
    $sroute = 'story';
    if ($story->story_type == 'emutoday'){
        $story->story_type = 'story';
    }
    $stypes = $story->story_type;
    $tags = \emutoday\Tag::lists('name', 'id');
    $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
    JavaScript::put([
        'stype' => $stypes,
        'storytype' => $story->story_type,
        'is_featured' => $story->is_featured,
    ]);
    $user = auth()->user();
    if($user == null)
    {
        return redirect(route('admin.dashboard'));
    }


    if ($user->hasRole('contributor_1'))
    {
        $stypelist = $story->story_type;
        $storyGroup = $story->storyGroup->group;
        $imagetypeNames = null;
        $currentStoryImages = null;
        $leftOverImages = null;
        // dd($leftOverImages);
        $requiredImages = null;
        $otherImages = null;



        // return view('admin.story.role.form', compact('story', 'stypes', 'tags'));
        return view('admin.story.form', compact('story','sroute', 'stypes', 'tags','stypelist','requiredImages','otherImages', 'leftOverImages'));

    } else {
        $storyGroup = $story->storyGroup->group;
        $imagetypeNames = Imagetype::ofGroup($storyGroup)->get()->keyBy('id');
        $currentStoryImages = $story->storyImages->pluck('image_type','imagetype_id');
        $leftOverImages = $imagetypeNames->diffKeys($currentStoryImages);
        // dd($leftOverImages);
        $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
        $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();
        return view('admin.story.form', compact('story','sroute', 'stypes', 'tags','stypelist','requiredImages','otherImages', 'leftOverImages'));

    }


}


private function syncTags(Story $story, array $tags)
{
    $story->tags()->sync($tags);

}


/**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    // public function index(Request $request)
    // {
    //     $user = auth()->user();
    //         if($user == null)
    //         {
    //             return redirect(route('admin.dashboard'));
    //         }
    //     $storys =   $this->story->newQuery();
    //         if ($user->hasRole('contributor_1'))
    //         {
    //
    //               return view('admin.story.role.index', compact('storys'));
    //         } else {
    //             $stype = $request->get('stype');
    //             $order = $request->get('order');
    //             $dir = $request->get('dir');
    //             $page_appends = null;
    //
    //             if (!$stype || $stype == 'all') {
    //                 $stype = 'all';
    //             } else {
    //                 $storys = $this->story->ofStoryType($stype)->get();
    //                 dd($storys);
    //                 // $storys->storyTypes()->where('group', $stype);
    //                 // where('story_type', $stype);
    //             }
    //
    //             if (!$order && !$dir) {
    //         $order = 'created_at';
    //                     $dir = 'desc';
    //     }
    //             $storys = $storys->orderBy($order, $dir);
    //             // Tell the Paginator to append the following to the page URL as well
    //             $page_appends = [
    //                     'order' => $order,
    //                     'dir' => $dir,
    //             ];
    //     $storys = $storys->paginate(5);
    //             // $stypes = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
    //             $stypes = \emutoday\StoryType::all()->pluck('group','group');
    //             $stypes = $stypes->prepend('all', 'all');
    //
    //             $data['storys'] = $storys;
    //              $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
    //              $data['page_appends'] = $page_appends;
    //             $data['stype'] = $stype;
    //             $data['stypes'] = $stypes;
    //
    //             return view('admin.story.index', $data);
    //             }
    // }
    //

    /**
     * Route::get('story/setup/{stype}/', ['as' => 'admin_story_setup', 'uses' => 'Admin\StoryController@setup']);
     * @param  [type] $stype [description]
     * @return [type]        [description]
     */
    // public function setup($stype)
    // {
    //     $story = new Story;
    //     $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
    //
    //     if ($stype != 'story' ) {
    //         $story->story_type = $stype;
    //         // if ($stype == 'storyexternal'){
    //         //         return view('admin.story.external', compact('story', 'stype'));
    //         // } else {
    //             $stypes = $story->story_type;
    //             // return view('admin.story.create', compact('story', 'stypes'));
    //         // }
    //     } else {
    //         $stypes = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
    //         // return view('admin.story.create', compact('story', 'stypes'));
    //     }
    //     $user = \Auth::user();
    //     JavaScript::put([
    //         'storytype' => $stype,
    //         'crntuser' => $user
    //     ]);
    //
    //     return view('admin.story.form', compact('story', 'stypes','stypelist'));
    //
    //
    // }






    // public function build(Story $story, $value)
    // {
    //
    //     $storyType = $value;
    //     if ($storyType == 'storyexternal') {
    //         return view('admin.story.buildexternal', compact('story', 'storyType'));
    //     } else {
    //         return view('admin.story.build', compact('story', 'storyType'));
    //     }
    //
    // }
// public function imageUpload(Request $request)
        // {
        // $file = $request->file('upload');
        // $uploadDestination = public_path() . '/imgs/uploads/story';
        //
        // $filename = preg_replace('/\s+/', '', $file->getClientOriginalName());
        // $fileName = md5($filename) . "_" . $filename;
        // $file->move($uploadDestination, $fileName);
        // }

        // public function imageBrowse(Request $request)
        // {
        // 	$test = $_GET['CKEditorFuncNum'];
        // 	$images = [];
        // 	$files = \File::files(public_path() . '/imgs/uploads/story');
        // 	foreach ($files as $file) {
        // 		$images[] = pathinfo($file);
        // 	}
        //
        // 	return view('admin.story.imageview',[
        // 				'files' => $images,
        // 				'test' => $test
        // 	]);
        // 	}



            // });



}
