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

    public function findWithOwnerAndMember($userId)
    {
        return $this->scopeQuery(function($query) use ($userId) {
            return $query->select('projects.*')
            ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')
            ->where('project_members.member_id', '=', $userId)
            ->union($this->model->query()->getQuery()->where('owner_id', '=', $userId));
        })->all();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
