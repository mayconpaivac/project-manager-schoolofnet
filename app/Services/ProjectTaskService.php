<?php

namespace ManagerProject\Services;

use ManagerProject\Repositories\ProjectTaskRepository;
use ManagerProject\Repositories\ProjectRepository;
use ManagerProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService {
	/**
	 * @var ProjectTaskRepository
	 */
	protected $repository;
	/**
	 * @var ProjectRepository
	 */
	protected $projectRepository;
	/**
	 * @var ProjectTaskValidator
	 */
	protected $validator;

	public function __construct(ProjectTaskRepository $repository, ProjectRepository $projectRepository, ProjectTaskValidator $validator)
	{
		$this->repository = $repository;
		$this->projectRepository = $projectRepository;
		$this->validator = $validator;
	}

	public function create(array $data, $idProject)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			
			$data['user_id'] = \Authorizer::getResourceOwnerId();
			$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
			$projectTask = $project->tasks()->create($data);

			return response()->json([
				'success' => true,
				'data'	=> $projectTask,
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	public function update(array $data, $idProject, $idTask)
	{
		try {
			$this->validator->with($data)->passesOrFail();

			$projectTask = $this->repository->update($data, $idTask);

			return response()->json([
				'success' => true,
				'data' => $projectTask,
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	public function show($idProject, $idTask)
	{
		$data = $this->repository->findWhere(['project_id' => $idProject, 'id' => $idTask]);
		return response()->json([
			'data' => $data['data'][0],
		]);
	}

	public function destroy($idProject, $idTask)
	{
		if($this->repository->delete($idTask)) {
			return response()->json([
				'success' => true,
			]);
		}

		return response()->json([
			'success' => false,
			'message' => 'Erro ao excluir tarefa.'
		]);
	}

}