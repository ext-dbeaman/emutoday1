<?php

namespace emutoday\Emutoday\Transformers;

 class MiniCalendarTransformer extends Transformer
{
    public function transform($minicalendar)
    {
        return [
            'id' => $minicalendar['id'],
            'calendar' => $minicalendar['calendar'],
            'slug' => $minicalendar['slug']

        ];
    }
}
