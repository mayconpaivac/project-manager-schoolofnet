<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\ProjectTask;

class ProjectTaskTransformer extends TransformerAbstract
{

    public function transform(ProjectTask $projectTask)
    {
        return [
            'id'            => (int) $projectTask->id,
            'title'         => $projectTask->title,
            'project_id'    => (int) $projectTask->project_id,
            'start_date'    => $projectTask->start_date,
            'due_date'      => $projectTask->due_date,
            'status'        => (int) $projectTask->status,
        ];
    }

}