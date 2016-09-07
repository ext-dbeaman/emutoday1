<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Magazine;
use emutoday\Story;
use Carbon\Carbon;
use JavaScript;

class MagazineController extends Controller
{
    protected $magazine;

    public function __construct(Magazine $magazine, Story $story)
    {
        $this->magazine = $magazine;
        $this->story = $story;

    }
    public function index($year = null, $season = null)
    {
        $currentDateTime = Carbon::now();
        $currentIssue = false;
        if ($year == null) {

          $magazine = $this->magazine->where([
              ['is_published', 1],
              ['is_archived', 0],
          ])->first();
            $currentIssue = true;
        } else {
          if ($season == null) {
            $magazine = $this->magazine->where([
                ['year', $year],
            ])->first();
          } else {
            $magazine = $this->magazine->where([
                ['year', $year],
                ['season', $season],
            ])->first();
          }

        }

        JavaScript::put([
            'jsis' => 'hi',
        ]);
        // $magazine = $this->magazines->findOrFail($id);
        // $storyImages = $this->magazines->storyImages();
        $storyImages = $this->magazine->storyImages();
        $barImgs = collect();
                $magazineCover = $magazine->mediafiles()->where('type','cover')->first();
                $magazineExtra = $magazine->mediafiles()->where('type','extra')->first();


        if ($currentIssue){

          foreach ($magazine->storys as $story) {
                if ($story->pivot->story_position === 0) {
                    $heroImg = $story->storyImages()->where('image_type', 'front')->first();
                } else {
                    $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
                }

            }
          return view('public.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs', 'magazineCover','magazineExtra'));
        } else {
          foreach ($magazine->storys as $story) {
              if ($story->pivot->story_position === 0) {
                  $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
              } else {
                  $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
              }

          }


          return view('public.magazine.issue', compact('magazine', 'storyImages', 'barImgs','magazineCover','magazineExtra'));

        }
        //

    }
    // public function index(Magazine $magazines)
    // {
    //     $currentDateTime = Carbon::now();
    //     $magazine = $this->magazines->where([
    //         ['is_published', 1],
    //         ['is_archived', 0],
    //     ])->first();
    //   //  $page = $this->pages->whereBetween('start_date',[Carbon::now()->subDays(7), Carbon::now()->addDays(7)] )->first();
    //     // $storys = $page->storys()->get();
    //
    //     $storyImages = $this->magazines->storyImages();
    //     $barImgs = collect();
    //
    //
    //     foreach ($magazine->storys as $story) {
    //         if ($story->pivot->story_position === 0) {
    //             $heroImg = $story->storyImages()->where('image_type', 'imagehero')->first();
    //         } else {
    //             $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
    //         }
    //
    //     }
    //     JavaScript::put([
    //         'jsis' => 'hi',
    //     ]);
    //     // $magazine = $this->magazines->findOrFail($id);
    //     // $storyImages = $this->magazines->storyImages();
    //     return view('public.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs'));
    //
    // }

    public function issue($year = null, $season = null)
    {
        $currentDateTime = Carbon::now();
        if ($year == null) {
          $magazine = $this->magazine->where([
              ['is_published', 1],
              ['is_archived', 0],
          ])->first();
        } else {
          $magazine = $this->magazine->where([
              ['year', $year],
              ['season', $season],
          ])->first();
        }

        $storyImages = $this->magazine->storyImages();
        $barImgs = collect();


        foreach ($magazine->storys as $story) {
            if ($story->pivot->story_position === 0) {
                $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
            } else {
                $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
            }

        }
        JavaScript::put([
            'jsis' => 'hi',
        ]);

                $magazineCover = $magazine->mediafiles()->where('type','cover')->first();
                $magazineExtra = $magazine->mediafiles()->where('type','extra')->first();
        // $magazine = $this->magazines->findOrFail($id);
        // $storyImages = $this->magazines->storyImages();
        return view('public.magazine.issue', compact('magazine', 'storyImages', 'barImgs','magazineCover','magazineExtra'));

    }
    public function article($id)
    {
        $story = $this->story->findOrFail($id);
        $magazine = $story->magazines->first();
        //$story = $magazine->storys()->where('id', $id)->first();
        $mainImage = $story->storyImages()->where('image_type', 'story')->first();
                // dd($mainImage);
        $sideFeaturedStorys = $this->story
                                  ->where([
                                    ['story_type', 'story'],
                                    ['id', '<>', $id],
                                                                        ['is_approved', 1],
                                  ])
                                  ->orWhere([
                                    ['story_type', 'student'],
                                    ['id', '<>', $id],
                                                                        ['is_approved', 1],
                                  ])
                                  ->orderBy('created_at', 'desc')->with('storyImages')->take(3)->get();

        $sideStoryBlurbs = collect();
            foreach ($sideFeaturedStorys as $sideFeaturedStory) {
                $sideStoryBlurbs->push($sideFeaturedStory
                                                                ->storyImages()
                                                                ->where('image_type', 'small')
                                                                ->first());
            }


        $sideNewsStorys = $this->story
                            ->where([
                              ['story_type', 'news'],
                              ['id', '<>', $id],
                                                            ['is_approved', 1],
                                ])->orderBy('created_at', 'desc')->take(3)->get();

        return view('public.magazine.article', compact('magazine','story', 'mainImage','sideStoryBlurbs','sideNewsStorys'));

    }


}
