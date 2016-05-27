<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\ProjectNote;

class ProjectNoteTransformer extends TransformerAbstract
{

    public function transform(ProjectNote $projectNote)
    {
        return [
            'id'            => (int) $projectNote->id,
            'project_id'    => (int) $projectNote->project_id,
            'title'      	=> $projectNote->title,
            'note'      	=> $projectNote->note,
        ];
    }

}