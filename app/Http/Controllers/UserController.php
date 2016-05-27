<?php

namespace ManagerProject\Http\Controllers;

use Illuminate\Http\Request;
use ManagerProject\Http\Controllers\Controller;
use ManagerProject\Http\Requests;
use ManagerProject\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        return $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getAuthenticated()
    {
        $idUser = \Authorizer::getResourceOwnerId();
        return $this->repository->find($idUser);
    }
}
