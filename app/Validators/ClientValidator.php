<?php

namespace ManagerProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator {


   	protected $messages = [
		    'email.required' => 'E-mail',
	];
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

}