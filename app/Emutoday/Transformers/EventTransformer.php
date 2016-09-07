<?php

namespace emutoday\Emutoday\Transformers;

 class EventTransformer extends Transformer
{
    public function transform($event)
    {
        return [
            'id' => $event['id'],
            'title' => $event['title'],
            'short_title' => $event['short_title'],
            'location' => $event['location']

        ];
    }
}
