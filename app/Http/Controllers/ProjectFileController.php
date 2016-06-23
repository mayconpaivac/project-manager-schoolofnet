<?php

namespace ManagerProject\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ManagerProject\Http\Requests;
use ManagerProject\Repositories\ProjectFileRepository;
use ManagerProject\Services\ProjectFileService;


class ProjectFileController extends Controller
{

    /**
     * @var ProjectFileRepository
     */
    protected $repository;

    /**
     * @var ProjectService
     */
    protected $service;

    /**
     * @param ProjectFileRepository $repository 
     * @param ProjectFileService    $service    
     */
    public function __construct(ProjectFileRepository $repository, ProjectFileService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idProject)
    {
        return $this->repository->findWhere(['project_id' => $idProject]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($idProject, $idFile)
    {
        return $this->service->getFilePath($idFile);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idProject)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        return $this->service->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idProject, $idFile)
    {
        $projectFile = $this->repository->find($idFile);
        if($projectFile) {
            return $projectFile;
        }

        return response()->json(['success' => false, 'message' => 'not_found'], 400);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $idProject, $idFile)
    {
        return $this->service->update($request->all(), $idProject, $idFile);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProject, $idFile)
    {
        return $this->service->destroy($idProject, $idFile);
    }
}
