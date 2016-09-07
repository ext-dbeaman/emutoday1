<?php

namespace emutoday\Providers;

use emutoday\Story;
use emutoday\Page;
use emutoday\StoryImage;
use emutoday\Mediafile;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
         'Illuminate\Auth\Events\Login' => [
            'emutoday\Listeners\UpdateLastLoginAtOnLogin@handle',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        StoryImage::saving(function ($storyImage)
        {

            if (isset($storyImage->filename))
            {
                if(is_null($storyImage->filename))
                {
                    $storyImage->is_active = 0;
                } else {
                    if(empty($storyImage->image_name) || empty($storyImage->image_extension))
                    {
                        $storyImage->is_active = 0;
                    } else {
                        $storyImage->is_active = 1;
                    }
                }
            } else {
                $storyImage->is_active = 0;
            }

            // $storyImage->filename = $storyImage->image_name . '.' . $storyImage->image_extension;

       });


       Mediafile::saving(function ($mediafile)
       {

           if (isset($mediafile->filename))
           {
               if(is_null($mediafile->filename))
               {
                   $mediafile->is_active = 0;
               } else {
                   if(empty($mediafile->name) || empty($mediafile->ext))
                   {
                       $mediafile->is_active = 0;
                   } else {
                       $mediafile->is_active = 1;
                   }
               }
           } else {
               $mediafile->is_active = 0;
           }

           // $storyImage->filename = $storyImage->image_name . '.' . $storyImage->image_extension;

      });

      Story::saving(function ($story)
      {

        switch ($story->story_type) {
            case 'external':
                $story->is_ready = ($story->storyImages->where('is_active',1)->count()>0)?1:0;
                $story->is_promoted = ($story->storyImages->where('is_active',1)->count()>0)?1:0;
                break;
            case 'story':
            case 'article':
            case 'student':
                $story->is_ready = ($story->storyImages->where('is_active',1)->count()<2)?0:1;
                $story->is_promoted = ($story->storyImages->where('is_active',1)->count()<2)?0:1;
                break;
            case 'news':
                $story->is_ready = 1;
                break;    
            default:
                  # code...
                  break;
          }
      });
      Page::saving(function ($page)
      {
          $page->is_ready = ($page->storys()->count() === $page->template_elements )?1:0;


      });

        //
    }
}
