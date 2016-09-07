<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Building;


use Illuminate\Http\Request;

use emutoday\Emutoday\Transformers\FractalBuildingTransformer;

use League\Fractal\Manager;
use League\Fractal;


class BuildingController extends ApiController
{
	function __construct(Building $building)
	{
		$this->building = $building;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
			$text = \Input::get('q');

			$fractal = new Manager();

			$buildings = Building::likeSearch('name', $text)->get();

			$resource = new Fractal\Resource\Collection($buildings->all(), new FractalBuildingTransformer);
				// Turn all of that into a JSON string
				return $fractal->createData($resource)->toJson();
			// return $this->respond([
			//     'data' => $this->storyTransformer->transformCollection($storys->all())
			// ]);
	}
}
