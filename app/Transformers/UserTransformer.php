<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\User;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $client)
    {
        return [
            'id'            => (int) $client->id,
            'name'          => $client->name,
            'email'         => $client->email,
        ];
    }

}