<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Story;
use emutoday\StoryImage;
use Carbon\Carbon;
use JavaScript;

class StudentController extends Controller
{
  protected $storys;

  public function __construct(Story $story)
  {

      $this->story = $story;



  }

  public function index($id = null)
  {
      $currentDateTime = Carbon::now();

			if ($id) {
        $story = $this->story->findOrFail($id);
				$mainStoryImages = $story->storyImages()->get();
				foreach($mainStoryImages as $mainimg){
					if($mainimg->imgtype->type == 'story') {
						$mainStoryImage = $mainimg;
						break;
					}
				}

				$sideFeaturedStorys = $this->story->where([
						['story_type', 'story'],
						['id', '<>', $id],
						['is_approved', 1],
						])->orderBy('created_at', 'desc')->with(['storyImages'=> function($query) {
							$query->where('image_type', 'small');
						}])->take(3)->get();
						$sideStoryBlurbs = collect();
						foreach ($sideFeaturedStorys as $sideFeaturedStory) {
								$sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'small')->first());
						}

			$sideStudentStorys = $this->story->where([
								['story_type', 'student'],
								['id', '<>', $id],
								['is_approved', 1],
								])->orderBy('created_at', 'desc')->with(['storyImages'=> function($query) {
									$query->where('image_type', 'small');
								}])->take(3)->get();

								$sideStudentBlurbs = collect();
								foreach ($sideStudentStorys as $sideStudentStory) {
										$sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'small')->first());
								}

				// $sideFeaturedStorys = $this->storys->where([
				// 		['story_type', 'storypromoted'],
				// 		['id', '<>', $id],
				// 		['is_approved', 1],
				// 		])->orderBy('created_at', 'desc')->with('storyImages')->take(3)->get();
				//
				// 		$sideStoryBlurbs = collect();
				// 		foreach ($sideFeaturedStorys as $sideFeaturedStory) {
				// 				$sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'emutoday_small')->first());
				// 		}
				//
				// 		$sideStudentStorys = $this->storys->where([
				// 				['story_type', 'storystudent'],
				// 				['id', '<>', $id],
				// 					['is_approved', 1],
				// 		])->orderBy('created_at', 'desc')->take(3)->get();
				// 		$sideStudentBlurbs = collect();
				// 		foreach ($sideStudentStorys as $sideStudentStory) {
				// 				$sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'student_small')->first());
				// 		}
        // $mainStoryImage = $story->storyImages()->where('image_type', 'imagemain')->first();
        // $sideFeaturedStorys = $this->storys->where([
        //     ['story_type', 'storypromoted'],
        //     ['id', '<>', $id],
				// 		['is_approved',1],
        //     ])->orderBy('created_at', 'desc')->with('storyImages')->take(3)->get();
				//
        //     $sideStoryBlurbs = collect();
        //     foreach ($sideFeaturedStorys as $sideFeaturedStory) {
        //         $sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'imagesmall')->first());
        //     }
				//
				//
        // $sideStudentStorys = $this->storys->where([
        //     ['story_type', 'storystudent'],
        //     ['id', '<>', $id],
        // ])->orderBy('created_at', 'desc')->take(3)->get();
        // $sideStudentBlurbs = collect();
        // foreach ($sideStudentStorys as $sideStudentStory) {
        //     $sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'imagesmall')->first());
        // }
        // dd($sideStoryBlurbs->first()->present()->mainImageURL);

        return view('public.student.main', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));
      } else {

				$studentStorysApproved = $this->story->where([
									['story_type', 'student'],
									['is_approved', 1],
									])->orderBy('created_at', 'desc')->with('storyImages')->get();


									// $studentStorysFeatured = collect();
									// $studentStorysFeatured = collect();
									// foreach ($sideStudentStorys as $sideStudentStory) {
									// 		$sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'small')->first());
									// }

				$studentStoryFeatured = $studentStorysApproved->filter(function ($story){
					return $story->is_featured == 1;
				}
			);


				$studentStoryFeatured->all();
				// dd($studentStoryFeatured);

				$studentStorysNotFeatured = $studentStorysApproved->reject(function ($story){
						return $story->is_featured == 1;
				});
				$studentStorysNotFeatured->all();

				// dd($studentStorysNotFeatured);
  			$barImgs = collect();
				if($studentStoryFeatured->count() > 1) {

					for ($i = 0; $i < $studentStoryFeatured->count(); $i++) {
						if($i == 0){
							$heroImg = $studentStoryFeatured[0]->storyImages()->where('image_type', 'front')->first();
						} else if ($i == 1) {
							$featureImg = $studentStoryFeatured[1]->storyImages()->where('image_type', 'story')->first();
						} else {
							$barImgs->push($studentStoryFeatured[$i]->storyImages()->where('image_type', 'small')->first());
						}
					}
				} else {
					$heroImg = $studentStoryFeatured->first()->storyImages()->where('image_type', 'front')->first();
					$featureImg = $studentStorysNotFeatured->shift()->storyImages()->where('image_type', 'story')->first();
				}
				foreach ($studentStorysNotFeatured as $ss) {
            $barImgs->push( $ss->storyImages()->where('image_type', 'small')->first() );
        }


					// $heroImg = $studentStoryFeatured->storyImages()->where('image_type', 'front')->first();



				// $this->storys->where('story_type', 'storystudent')->get();
				//
        // $studentHeroStory = $studentStorys->where('is_featured', 1)->first();
				//
				//
				//
        // $heroImg = $studentStoryFront->storyImages()->where('image_type', 'front')->first();
				//
				//
        // $barImgs = collect();
        // foreach ($studentStorysFiltered as $ss) {
        //     $barImgs->push( $ss->storyImages()->where('image_type', 'small')->first() );
        // }



        JavaScript::put([
            'jsis' => 'hi',

        ]);

        return view('public.student.index', compact('heroImg', 'featureImg','barImgs'));
      }


  }
}
