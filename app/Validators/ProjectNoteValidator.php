<?php

namespace ManagerProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator {

    protected $rules = [
    	'project_id' 	=> 'required|integer',
    	'title'			=> 'required',
    	'note'			=> 'required'
   	];

}