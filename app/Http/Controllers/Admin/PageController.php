<?php

namespace emutoday\Http\Controllers\Admin;


use emutoday\Page as Page;
use emutoday\Story;
use emutoday\StoryImage;

use Illuminate\Http\Request;
use JavaScript;
use emutoday\Http\Requests;
use Carbon\Carbon;

class PageController extends Controller
{

    protected $page;

    public function __construct(Page $page, Story $story, StoryImage $storyImage)
    {
        $this->page = $page;
        $this->story = $story;
        $this->storyImage = $storyImage;
    }

    public function index()
    {
        $currentDate = Carbon::now();


        $pages_notready_current = Page::where([
            ['is_ready', 0],
            ['end_date', '>=' ,$currentDate ]
            ])->orderBy('start_date', 'asc')->get();

        $pages_ready_current = Page::where([
                ['is_ready', 1],
                ['end_date', '>=' ,$currentDate ]
                ])->orderBy('start_date', 'asc')->get();

            $pages_ready_past = Page::where([
                ['is_ready', 1],
                ['end_date', '<' ,$currentDate ]
                ])->orderBy('start_date', 'asc')->get();

            $pages_notready_past = Page::where([
                ['is_ready', 0],
                ['end_date', '<' ,$currentDate ]
                ])->orderBy('start_date', 'asc')->get();
                //  dd($pages_notready_current, $pages_ready_current);

//         Page::has('storys', '<', 5)->orderBy('start_date', 'asc')->get();
// $pages_past =
        $pgselect = Page::has('storys', '>=', 5)->select('id', 'template','start_date', 'end_date')->get();

        // = \DB::table('pages')->where('storys',5)->select('id', 'template','start_date', 'end_date')->get();
        // $strys = \DB::table('storys')->select('id', 'title', 'start_date', 'end_date')->get();
        $pgs = collect($pgselect)->toJson();

        JavaScript::put([
            'pgselect' => $pgselect,
            'pgs' => $pgs

        ]);


        return view('admin.page.index',compact('pages_ready_current','pages_notready_current','pages_ready_past','pages_notready_past', 'pgs'));

        // return view('admin.page.index',compact('pages','pgs','strys'));
    }

     public function appLoad(){
         $pages = $this->page->orderBy('updated_at', 'desc')->get();

         $pgs = \DB::table('pages')->select('id', 'uri','start_date', 'end_date')->get();
         $strys = \DB::table('storys')->select('id', 'title', 'start_date', 'end_date')->get();

         JavaScript::put([
             'jsis' => 'foobar',
             'pagearray' => $pgs,
             'pages' => $pages
         ]);
         return view('admin.page.app', compact('pages','pgs','strys'));
     }


    public function create(Page $page)
    {

        return view('admin.page.create', compact('page'));
    }

    public function store(Requests\StorePageRequest $request)
    {
        $page = $this->page->create(
        [ 'user_id' => auth()->user()->id ] + $request->only('template', 'uri', 'start_date', 'end_date')

    );
        flash()->success('Page has been created.');
        return redirect(route('admin.page.edit', $page->id));//->with('status', 'Story has been created.');
    }

    public function show($id)
    {
        $page = $this->page->findOrFail($id);
        // $storyImages = $this->storyImages->get();
        // $storys =  $this->storys->orderBy('updated_at', 'desc')->take(8)->get();
        // $storyImages = $this->pages->storyImages();
        $storyImages = $this->page->storyImages();
        return view('admin.page.preview', compact('page', 'storyImages'));

    //    return view('admin.pages.show', compact('page'));
    }

    /**
     * Confirm the deletion of record
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm($id)
    {
        $page = $this->page->findOrFail($id);
        return view('admin.page.confirm', compact('page'));
    }

    public function edit($id)
    {
        $page = $this->page->findOrFail($id);
            $storys = Story::where([
                                ['story_type','!=' ,'news'],
                                ['is_approved',1],
                    ])->with('images')->get();
            $storyimgs = $this->storyImage->where([
                                                ['group','!=','news'],
                                                ['image_type', 'small'],
                                                ])
                                                ->orderBy('updated_at', 'desc')->get();
                $connectedStorys = $page->storys()->get();

                $original_story_ids = $connectedStorys->pluck('id');

                // original_story_ids = JSvars.original_story_ids;
                // mainrecord_id = JSvars.mainrecordid;
        JavaScript::put([
            'mainrecordid' => $page->id,
            'original_story_ids'=> $original_story_ids,
            'storysonpage' => $connectedStorys->toArray(),
            'storyimgs' => $storyimgs->toArray(),
            'storys' => $storys->toArray()
        ]);
        // return view('admin.page.form', compact('page', 'storys'));
        //return view('admin.magazine.edit', compact('page', 'storys'));
        //
        // dd($page,$storys,$storyimgs);
        return view('admin.page.edit', compact('page', 'storys','storyimgs'));

        //  return view('admin.page.edit', compact('page', 'storys'));

    }

    public function update(Requests\UpdatePageRequest $request, $id)
    {
        $page = $this->page->findOrFail($id);
        $storyIDString =  $request->get('story_ids');
        $storyIDarray = explode(",", $storyIDString);
        $storyIDarrayCount = count($storyIDarray);
        $storyIDsForPivotArray = [];

         for ($x = 0; $x < $storyIDarrayCount; $x++) {
            // $attributes = array()
             //$pushval = $storyIDarray[$x] . " => ['page_position' => " . intval($x) . "]";
             $namedKey = $storyIDarray[$x];
             if($namedKey != 0) {
                 $attributeArray = array();
                 $attributeArray["page_position"] = intval($x);
                 $attributeArray["note"] = 'some notes';
                 $storyIDsForPivotArray[intval($namedKey)] = $attributeArray;
             }
             //array_push($storyIDsForPivotArray, $pushval);
            }
             if (empty($storyIDsForPivotArray)) {
                 $page->is_ready = 0;
             } else {
                 if(count($storyIDsForPivotArray) < $page->template_elements){
                     $page->is_ready = 0;
                 } else {
                     $page->is_ready = 1;
                 }
            //  dd($storyIDsForPivotArray);
             $page->storys()->sync($storyIDsForPivotArray);
            }

        $page->uri = $request->uri;
        $page->start_date = \Carbon\Carbon::parse($request->start_date);
        $page->end_date = \Carbon\Carbon::parse($request->end_date);
        // $page->is_active = $request->is_active;

        $page->save();

        //$story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','story_type'))->save();
        flash()->success('Page has been updated.');
        return redirect(route('admin.page.edit', $page->id));
        //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
    }

        public function delete(Request $request)
        {
            $page = $this->page->findOrFail($request->get('id'));
            $page->delete();
            flash()->warning('Page has been deleted.');
            return redirect(route('admin.page.index'));//->with('status', 'Story has been deleted.');
        }
    public function destroy($id)
    {
        $page = $this->page->findOrFail($id);
        $page->delete();
        flash()->warning('Page has been deleted.');
        return redirect(route('admin.page.index'));//->with('status', 'Story has been deleted.');
    }


}
