<?php

namespace ManagerProject\Services;

use ManagerProject\Repositories\ProjectRepository;
use ManagerProject\Validators\ProjectValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService {
	/**
	 * @var ProjectRepository
	 */
	protected $repository;
	/**
	 * @var ProjectValidator
	 */
	protected $validator;

	public function __construct(ProjectRepository $repository, ProjectValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function create(array $data)
	{
		try {
			$userId = \Authorizer::getResourceOwnerId();
			$data['owner_id'] = $userId; 

			$data['due_date'] = \Carbon\Carbon::parse($data['due_date'])->format('Y-m-d');

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			return response()->json([
				'success' => true,
				'data' => $this->repository->create($data),
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	public function show($id)
	{
		try {
			$show = $this->repository->find($id);
			return $show;
		} catch (Exception $e) {
			return 'no';
		}
	}

	public function update(array $data, $id)
	{
		try {
			$data['due_date'] = \Carbon\Carbon::parse($data['due_date'])->format('Y-m-d');
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			return response()->json([
				'success' => true,
				'data' => $this->repository->update($data, $id),
			]);
		} catch (ValidatorException $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	public function destroy($id)
	{
		if($this->repository->delete($id)) {
			return response()->json([
				'success' => true,
				'message' => 'Projeto excluído.',
			]);
		}

		return response()->json([
			'success' => false,
			'message' => 'Erro ao excluir projeto',
		]);
	}

}