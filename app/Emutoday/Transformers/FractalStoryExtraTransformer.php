<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Story;
use League\Fractal;
use Carbon\Carbon;

class FractalStoryExtraTransformer extends Fractal\TransformerAbstract
{
    public function transform(Story $story)
    {
        return [
            'id'      => (int) $story->id,
            'story_type'   => $story->storyGroup->group,
            'title'    =>  $story->title,
            'approved' => $story->is_approved,
            'promoted' => $story->is_promoted,
            'featured' =>  $story->is_featured,
            'live' =>  $story->is_live,
            'archived' =>  $story->is_archived,
            'start_date'   => $story->start_date->format('m-d-Y'),
            'tags' => $story->tags->pluck('name')
        ];
    }
}
