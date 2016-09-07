<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Category;
use League\Fractal;


class FractalCategoryTransformer extends Fractal\TransformerAbstract
{
	public function transform(Category $category)
	{
	    return [
	        'id'      => (int) $category->id,
	        'category'   => $category->category
				];
	}
}
