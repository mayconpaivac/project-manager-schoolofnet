<?php

namespace ManagerProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'title',
    	'start_date',
    	'due_date',
    	'status',
        'project_id',
    	'user_id',
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

}
