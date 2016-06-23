<?php

namespace ManagerProject\Services;

use ManagerProject\Repositories\ProjectFileRepository;
use ManagerProject\Repositories\ProjectRepository;
use ManagerProject\Validators\ProjectFileValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService {
	/**
	 * @var ProjectFileRepository
	 */
	protected $repository;
	/**
	 * @var ProjectRepository
	 */
	protected $projectRepository;
	/**
	 * @var ProjectFileValidator
	 */
	protected $validator;
	/**
	 * @var Filesystem
	 */
	protected $filesystem;
	/**
	 * @var Storage
	 */
	protected $storage;

	/**
	 * @param ProjectFileRepository $repository        
	 * @param ProjectRepository     $projectRepository 
	 * @param ProjectFileValidator  $validator         
	 * @param Filesystem            $filesystem        
	 * @param Storage               $storage           
	 */
	public function __construct(ProjectFileRepository $repository, ProjectRepository $projectRepository, ProjectFileValidator $validator, Filesystem $filesystem, Storage $storage)
	{
		$this->repository = $repository;
		$this->projectRepository = $projectRepository;
		$this->validator = $validator;
		$this->filesystem = $filesystem;
		$this->storage = $storage;
	}

	/**
	 * @param  array  $data
	 * @return array
	 */
	public function create(array $data)
	{

		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
			
			$projectFile = $project->files()->create($data);

	        $this->storage->put($projectFile->id . '.' . $data['extension'], $this->filesystem->get($data['file']));
			return response()->json([
				'success' => true,
				'data' => $projectFile,
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	/**
	 * @param  array  $data     
	 * @param  int $idProject
	 * @param  int $idFile   
	 * @return array
	 */
	public function update(array $data, $idProject, $idFile)
	{
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

			return response()->json([
				'success' => true,
				'data' => $this->repository->update($data, $idFile),
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	/**
	 * @param  int $idProject
	 * @param  int $idNote   
	 * @return array           
	 */
	public function show($idProject, $idNote)
	{
		$data = $this->repository->findWhere(['project_id' => $idProject, 'id' => $idNote]);
		return response()->json([
			'data' => $data['data'][0],
		]);
	}

	/**
	 * @param  int $idProject
	 * @param  int $idNote   
	 * @return array           
	 */
	public function destroy($idProject, $idFile)
	{
		$projectFile = $this->repository->skipPresenter()->find($idFile, ['id', 'extension']);
		if($this->storage->exists($projectFile->id . '.' . $projectFile->extension)) {
			if($this->storage->delete($projectFile->id . '.' . $projectFile->extension)) {
				$projectFile->delete();
				return response()->json([
					'success' => true,
					'message' => 'Arquivo excluído.'
				]);
			}
		} else {
			$projectFile->delete();
			return response()->json([
				'success' => false,
				'message' => 'Registro excluído, mas o arquivo não foi encontrado.'
			]);
		}

		return response()->json([
			'success' => false,
			'message' => 'Erro ao excluir arquivo.'
		], 400);
	}

	public function getFilePath($id)
	{
		$projectFile = $this->repository->skipPresenter()->find($id, ['id', 'name', 'extension']);

        $filePath = $this->getBaseURL($projectFile);
        $fileContent = file_get_contents($filePath);
        $fileBase64 = base64_encode($fileContent);

        return response()->json([
            'file' => $fileBase64,
            'size' => filesize($filePath),
            'name' => $projectFile->name . '.' . $projectFile->extension,
        ]);

	}

	public function getBaseURL($projectFile)
	{
		switch ($this->storage->getDefaultDriver()) {
			case 'local':
				return $this->storage->getDriver()->getAdapter()->getPathPrefix() . '/' . $projectFile->id . '.' . $projectFile->extension;
				break;
		}
	}

}