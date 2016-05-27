<?php

namespace ManagerProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
    	ValidatorInterface::RULE_CREATE => [
	    	'owner_id'	=> 'required|integer',
	    	'client_id'	=> 'required|integer',
	    	'title'		=> 'required',
	    	'progress'	=> 'required|min:0|max:100',
	    	'status'	=> 'required',
	    	'due_date'	=> 'required|date_format:Y-m-d|after:today',
	    ],
    	ValidatorInterface::RULE_UPDATE => [
	    	'owner_id'	=> 'required|integer',
	    	'client_id'	=> 'required|integer',
	    	'title'		=> 'required',
	    	'progress'	=> 'required|min:0|max:100',
	    	'status'	=> 'required',
	    	'due_date'	=> 'required|date_format:Y-m-d|after:today',
	    ],
   	];

   	protected $attributes = ['due_date' => 'Data de vencimento'];

   	protected $messages = [
   		'due_date.after' => 'A data de vencimento deve ser maior que a data de hoje.'
   	];

}