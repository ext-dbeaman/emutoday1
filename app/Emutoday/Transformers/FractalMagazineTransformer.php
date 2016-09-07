<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Magazine;
use League\Fractal;
use Carbon\Carbon;

class FractalMagazineTransformer extends Fractal\TransformerAbstract
{
	public function transform(Magazine $magazine)
	{
	    return [
	        'id'      => (int) $magazine->id,
	        'year'   => $magazine->year,
	        'season'    =>  $magazine->season,
					'title' => $magazine->title,
					'published' =>  $magazine->is_published,
					'archived' => $magazine->is_archived,
          'start_date'   => $magazine->start_date? $magazine->start_date->toDateString() : 'No Start Date'
				];
	}
}
