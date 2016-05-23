<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\Client;

class ClientTransformer extends TransformerAbstract
{

    public function transform(Client $client)
    {
        return [
            'name'          => $client->name,
            'cpf_cnpj'      => $client->cpf_cnpj,
            'responsible'   => $client->responsible,
            'email'         => $client->email,
            'address'       => $client->address,
            'neighborhood'  => $client->neighborhood,
            'number'        => $client->number,
            'complement'    => $client->complement,
            'phone_1'       => $client->phone_1,
            'phone_2'       => $client->phone_2,
            'city'          => $client->city,
            'state'         => $client->state,
        ];
    }

}