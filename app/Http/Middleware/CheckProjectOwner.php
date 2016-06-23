<?php

namespace ManagerProject\Http\Middleware;

use Closure;
use ManagerProject\Services\ProjectService;

class CheckProjectOwner
{
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * @param ProjectService $service
     */
    public function __construct(ProjectService $service)
    {
        $this->service = $service;
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
        $projectId = $request->route('id') ? $request->route('id') : $request->route('projects');
        if($projectId) {
            if($this->service->checkProjectOwner($projectId)) {
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
