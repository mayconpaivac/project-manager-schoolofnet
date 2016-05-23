<?php

namespace ManagerProject\Repositories;

use ManagerProject\Presenters\ProjectPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ManagerProject\Repositories\ProjectRepository;
use ManagerProject\Entities\Project;
use ManagerProject\Validators\ProjectValidator;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace ManagerProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProjectValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isOwner($projectId, $userId)
    {
        if(count($this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
            return true;
        }
        return false;
    }

    public function isMember($projectId, $memberId)
    {
        $project = $this->skipPresenter()->find($projectId);

        foreach ($project->members as $member) {
            if($member->id == $memberId) {
                return true;
            }
        }

        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
