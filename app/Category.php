<?php

namespace emutoday;

use Baum\Node;

class Category extends Node
{
    protected $table = 'cea_categories';

		public function scopeLikeSearch($query, $field, $value){
			return $query->where($field, 'LIKE', "%$value%");
		}

    public function events() {
      return $this->belongsToMany('emutoday\Event', 'cea_category_event', 'category_id', 'event_id');
    }
}
