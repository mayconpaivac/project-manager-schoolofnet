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
	    	'progress'	=> 'required',
	    	'status'	=> 'required',
	    	'due_date'	=> 'required|date_format:d/m/Y|after:today',
	    ],
    	ValidatorInterface::RULE_UPDATE => [
	    ],
   	];

}