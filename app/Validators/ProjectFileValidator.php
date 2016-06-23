<?php

namespace ManagerProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator {

	protected $rules = [
    	ValidatorInterface::RULE_CREATE => [
	    	'project_id'	=> 'integer|required',
	    	'name'			=> 'required',
	    	'file'			=> 'required|mimes:jpeg,jpg,png,gif,pdf,zip,xls,xlsx,doc,docx',
	    	'description'	=> 'required',
	   	],
	   	
	   	ValidatorInterface::RULE_UPDATE => [
	    	'project_id'	=> 'integer|required',
	    	'name'			=> 'required',
	    	'description'	=> 'required',
	   	],
	   	
	];

}