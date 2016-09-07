<?php

namespace emutoday\Emutoday\Transformers;

 class AnnouncementTransformer extends Transformer
{
    public function transform($announcement)
    {
        return [
            'id' => $announcement['id'],
            'title' => $announcement['title'],
						'announcemtnt' => $announcement['announcement'],
            'submission_date' => $announcement['submission_date'],
            'start_date' => $announcement['start_date'],
						'end_date' => $announcement['end_date'],
						'approved' => $announcement['is_approved'],
						'approved_date' => $announcement['approved_date'],
						'priority' => $announcement['priority']
				];
    }
}
