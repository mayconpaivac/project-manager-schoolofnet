<?php

namespace ManagerProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Client extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'name',
    	'cpf_cnpj',
    	'responsible',
    	'email',
    	'address',
    	'neighborhood',
    	'number',
    	'complement',
    	'phone_1',
    	'phone_2',
    	'city',
        'state',
    	'obs',
    ];

}
