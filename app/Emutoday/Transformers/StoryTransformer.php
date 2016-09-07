<?php

namespace emutoday\Emutoday\Transformers;

 class StoryTransformer extends Transformer
{
    public function transform($story)
    {
        return [
            'story_id' => $story['id'],
            'story_type' => $story['story_type'],
            'title' => $story['title'],
            'content' => htmlspecialchars($story['content']),
            'start_date' => $story['start_date']
        ];
    }
}
