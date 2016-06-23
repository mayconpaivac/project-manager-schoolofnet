<?php

namespace ManagerProject\Http\Controllers;

use Illuminate\Http\Request;
use ManagerProject\Http\Requests;
use ManagerProject\Repositories\ProjectTaskRepository;
use ManagerProject\Services\ProjectTaskService;


class ProjectTaskController extends Controller
{

    /**
     * @var ProjectTaskRepository
     */
    protected $repository;

    /**
     * @var ProjectTaskService
     */
    protected $service;


    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store($idProject, Request $request)
    {
        $request['project_id'] = $idProject;
        return $this->service->create($request->all(), $idProject);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idProject, $idTask)
    {
        return $this->service->show($idProject, $idTask);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $idProject, $idTask)
    {
        return $this->service->update($request->all(), $idProject, $idTask);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProject, $idTask)
    {
        return $this->service->destroy($idProject, $idTask);
    }
}
