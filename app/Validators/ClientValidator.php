<?php

namespace ManagerProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator {

    protected $rules = [
    	'name' 			=> 'required|min:10',
    	'cpf_cnpj' 		=> 'required|unique:clients',
    	'responsible'	=> 'required',
    	'email'			=> 'required|email|unique:clients',
    	'address'		=> 'required',
    	'neighborhood'	=> 'required',
    	'number'		=> 'required',
    	'phone_1'		=> 'required|min:14',
    	'city'			=> 'required',
    	'state'			=> 'required|min:2|max:2'
   	];

    protected $attributes = [
        'name'          => 'Nome',
        'cpf_cnpj'      => 'CPF/CNPJ',
        'responsible'   => 'Responsável',
        'email'         => 'E-mail',
        'address'       => 'Endereço',
        'neighborhood'  => 'Bairro',
        'number'        => 'Número',
        'phone_1'       => 'Telefone',
        'city'          => 'Cidade',
        'state'         => 'Estado'
    ];

}