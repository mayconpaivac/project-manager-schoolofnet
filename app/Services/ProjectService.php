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

	/**
	 * @param ProjectRepository $repository
	 * @param ProjectValidator $validator
	 */
	public function __construct(ProjectRepository $repository, ProjectValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	/**
	 * @param  array $data
	 * @return array
	 */
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

	/**
	 * @param  int $id
	 * @return return array
	 */
	public function show($id)
	{
		try {
			$show = $this->repository->find($id);
			return $show;
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessageBag(),
			], 400);
		}
	}

	/**
	 * @param  array $data
	 * @param  int $id
	 * @return array
	 */
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

	/**
	 * @param  int $id
	 * @return array
	 */
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

	/**
	 * @param  int $projectId
	 * @return boolean
	 */
	public function checkProjectPermissions($projectId)
    {
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)) {
            return true;
        }
        return false;
    }

    /**
     * @param  int $projectId
     * @return boolean
     */
    public function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        if($this->repository->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId])->count()) {
            return true;
        }
        return false;
    }

    /**
     * @param  int $projectId
     * @return boolean
     */
    public function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $project = $this->repository->skipPresenter()->find($projectId, ['id']);

        foreach ($project->members as $member) {
            if($member->id == $userId) {
                return true;
            }
        }

        return false;
    }

}