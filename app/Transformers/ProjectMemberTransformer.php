<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\User;

class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(User $member)
    {
        return [
            'id'            => $member->id,
            'name'          => $member->name,
            'email'         => $member->email,
        ];
    }

}