<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Bugz;
use League\Fractal;
use Carbon\Carbon;

class FractalBugzTransformerModel extends Fractal\TransformerAbstract
{
	public function transform(Bugz $bugz)
	{
	    return [
	        'id'      => (int) $bugz->id,
					'priority' =>  $bugz->priority,
					'type' => $bugz->type,
					'screen' => $bugz->screen,
					'notes' => $bugz->notes,
					'reply' => $bugz->note_reply,
					'complete' => $bugz->complete,
					'confirmed' => $bugz->confirmed,
					'user_id'    =>  $bugz->user_id,
					'user_name'  => $bugz->user->last_name

	    ];
	}
}
