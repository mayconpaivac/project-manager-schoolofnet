<?php

namespace ManagerProject\Http\Controllers;

use Illuminate\Http\Request;
use ManagerProject\Http\Requests;
use ManagerProject\Repositories\ProjectNoteRepository;
use ManagerProject\Services\ProjectNoteService;


class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectNoteService
     */
    protected $service;


    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
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
        return $this->service->create($request->all(), $idProject);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idProject, $idNote)
    {
        return $this->service->show($idProject, $idNote);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $idProject, $idNote)
    {
        return $this->service->update($request->all(), $idProject, $idNote);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProject, $idNote)
    {
        return $this->service->destroy($idProject, $idNote);
    }
}
