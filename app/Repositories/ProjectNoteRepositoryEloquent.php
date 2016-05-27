<?php

namespace ManagerProject\Repositories;

use ManagerProject\Entities\ProjectNote;
use ManagerProject\Presenters\ProjectNotePresenter;
use ManagerProject\Repositories\ProjectNoteRepository;
use ManagerProject\Validators\ProjectNoteValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace ManagerProject\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNote::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProjectNoteValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return ProjectNotePresenter
     */
    public function presenter()
    {
        return ProjectNotePresenter::class;
    }
}
