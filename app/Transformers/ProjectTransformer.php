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
            'id'            => (int) $project->id,
            'owner_id'      => $project->owner_id,
            'client_id'      => $project->client_id,
            'title'         => $project->title,
            'description'   => $project->description,
            'progress'      => $project->progress,
            'status'        => $project->status,
            'due_date'      => $project->due_date,
            'is_member'     => $project->owner_id != \Authorizer::getResourceOwnerId(),
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