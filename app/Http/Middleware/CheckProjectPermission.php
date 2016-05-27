<?php

namespace ManagerProject\Http\Middleware;

use Closure;
use ManagerProject\Repositories\ProjectRepository;

class CheckProjectPermission
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = \Authorizer::getResourceOwnerId();

        $projectId = $request->projects ? $request->projects : $request->id;

        if($projectId) {
            if($this->repository->isOwner($projectId, $userId) or $this->repository->isMember($projectId, $userId)) {
                return $next($request);
            }
        } else {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'permission_denied'
        ], 400);
    }
}
