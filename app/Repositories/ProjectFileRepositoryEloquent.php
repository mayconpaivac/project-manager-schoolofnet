<?php

namespace ManagerProject\Repositories;

use ManagerProject\Entities\ProjectFile;
use ManagerProject\Presenters\ProjectFilePresenter;
use ManagerProject\Repositories\ProjectFileRepository;
use ManagerProject\Validators\ProjectFileValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProjectFileRepositoryEloquent
 * @package namespace ManagerProject\Repositories;
 */
class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectFile::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProjectFileValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return ProjectFilePresenter
     */
    public function presenter()
    {
        return ProjectFilePresenter::class;
    }
}
