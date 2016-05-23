<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\Project;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['members', 'client'];

    public function transform(Project $project)
    {
        return [
            'id'            => $project->id,
            'owner_id'      => $project->owner_id,
            'project'       => $project->title,
            'description'   => $project->description,
            'progress'      => $project->progress,
            'status'        => $project->status,
            'due_date'      => $project->due_date,
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }

}