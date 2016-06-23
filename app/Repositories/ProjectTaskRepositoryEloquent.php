<?php

namespace ManagerProject\Repositories;

use ManagerProject\Entities\ProjectTask;
use ManagerProject\Presenters\ProjectTaskPresenter;
use ManagerProject\Repositories\ProjectTaskRepository;
use ManagerProject\Validators\ProjectTaskValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace ManagerProject\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectTask::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProjectTaskValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return ProjectTaskPresenter
     */
    public function presenter()
    {
        return ProjectTaskPresenter::class;
    }
}
