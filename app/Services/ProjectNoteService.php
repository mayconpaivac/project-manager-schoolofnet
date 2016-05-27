<?php

namespace ManagerProject\Services;

use ManagerProject\Repositories\ProjectNoteRepository;
use ManagerProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService {
	/**
	 * @var ProjectNoteRepository
	 */
	protected $repository;
	/**
	 * @var ProjectNoteValidator
	 */
	protected $validator;

	public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function create(array $data, $idProject)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			return response()->json([
				'success' => true,
				'data'	=> $this->repository->create($data),
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	public function update(array $data, $idProject, $idNote)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			return response()->json([
				'success' => true,
				'data' => $this->repository->update($data, $idNote),
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	public function show($idProject, $idNote)
	{
		$data = $this->repository->findWhere(['project_id' => $idProject, 'id' => $idNote]);
		return response()->json([
			'data' => $data['data'][0],
		]);
	}

	public function destroy($idProject, $idNote)
	{
		if($this->repository->delete($idNote)) {
			return response()->json([
				'success' => true,
			]);
		}

		return response()->json([
			'success' => false,
			'message' => 'Erro ao excluir nota.'
		]);
	}

}