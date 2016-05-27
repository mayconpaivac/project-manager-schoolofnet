<?php

namespace ManagerProject\Services;

use ManagerProject\Repositories\ClientRepository;
use ManagerProject\Validators\ClientValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService {
	/**
	 * @var ClientRepository
	 */
	protected $repository;
	/**
	 * @var ClientValidator
	 */
	protected $validator;

	public function __construct(ClientRepository $repository, ClientValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function create(array $data)
	{
		try {
			$this->validator->with($data)->passesOrFail();
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

	public function update(array $data, $id)
	{
		try {
			$this->validator->with($data)->setId($id)->passes();
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
			return response()->json(['success' => true]);
		}
	}

}