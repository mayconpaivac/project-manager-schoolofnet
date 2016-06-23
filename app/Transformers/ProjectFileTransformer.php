<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\ProjectFile;

class ProjectFileTransformer extends TransformerAbstract
{

    public function transform(ProjectFile $projectFile)
    {
        return [
            'id'            => (int) $projectFile->id,
            'project_id'    => (int) $projectFile->project_id,
            'name'    		=> $projectFile->name,
            'extension'   	=> $projectFile->extension,
            'description'  	=> $projectFile->description,
        ];
    }

}