<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Building;
use League\Fractal;
use Carbon\Carbon;

class FractalBuildingTransformer extends Fractal\TransformerAbstract
{
	public function transform(Building $building)
	{
	    return [
	        'id'      => (int) $building->id,
	        'name'   => $building->name
				];
	}
}
