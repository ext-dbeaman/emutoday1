<?php

namespace emutoday\Emutoday\Transformers;

 class CategoryTransformer extends Transformer
{
    public function transform($category)
    {
        return [
            'id' => $category['id'],
            'category' => $category['category']

        ];
    }
}
